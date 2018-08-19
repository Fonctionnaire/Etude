<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 27/05/2018
 * Time: 13:01
 */

namespace App\Controller\Security;


use App\Entity\User\User;
use App\Form\ForgotPasswordChangeType;
use App\Form\ResetPasswordAddMailType;
use App\Service\ResetPasswordMail;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ResetPasswordController extends AbstractController
{

    /**
     * @Route("/mot-de-passe-oublie", name="forgot_password")
     * @Method("GET|POST")
     */
    public function resetPasswordAddMail(Request $request, ResetPasswordMail $resetPasswordMail)
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY') or $this->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
            throw new AccessDeniedException('Veuillez vous déconnecter pour accéder à cette page');
        }
        $form = $this->createForm(ResetPasswordAddMailType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $email = $form->get('email')->getData();
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->findOneByEmail($email);
            if($user)
            {
                $token = uniqid('conf', true);
                $user->setChangePasswordToken($token);
                $user->setChangePasswordTokenValidity(new \DateTime());
                $em->flush();
                $resetPasswordMail->sendResetPasswordMail($user);
                $this->addFlash('success', 'Un e-mail vient de vous être envoyé');
                return $this->redirectToRoute('login');
            }else{
                $this->addFlash('success', 'Un e-mail vient de vous être envoyé');
                return $this->redirectToRoute('login');
            }
        }

        return $this->render('security/resetPasswordAddMail.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/changement-de-mot-de-passe/{token}", name="change_forgot_password", requirements={"token" : ".+"})
     * @Method("GET|POST")
     */
    public function changePasswordWithToken(string $token, Request $request, UserPasswordEncoderInterface $userPasswordEncoder)
    {

        $em = $this->getDoctrine()->getManager();
        /** @var User|null $user */
        $user = $em->getRepository(User::class)->findOneBy(['changePasswordToken' => $token]);

        $tokenDate = $user->getChangePasswordTokenValidity()->diff(new \DateTime());
        dump($tokenDate);
        if (null === $user) {
            throw new NotFoundHttpException(sprintf('L\'utilisateur avec le token "%s" n\'existe pas', $token));
        }elseif ($tokenDate->i > 30)
        {
            throw new AccessDeniedException();
        }

        $form = $this->createForm(ForgotPasswordChangeType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $password = $userPasswordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre mot de passe a bien été édité.');
            return $this->redirectToRoute('login');
        }

        return $this->render('security/editProfilMdp.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}