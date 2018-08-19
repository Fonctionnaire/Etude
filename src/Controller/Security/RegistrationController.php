<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 24/01/2018
 * Time: 13:15
 */

namespace App\Controller\Security;

use App\Form\UserType;
use App\Entity\User\User;
use App\Service\registerMail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RegistrationController extends Controller
{
    /**
     * @Route("/inscription", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, registerMail $registerMail, Session $session)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $request = Request::createFromGlobals();
            $ip = $request->getClientIp();
            $user->setUserIp($ip);
            $user->setPassword($password);
            $token = uniqid('conf', true);
            $user->setConfirmationToken($token);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $registerMail->sendRegisterMail($user);
            $session->set(Security::LAST_USERNAME, $user->getUsername());

            $this->addFlash('success', 'Inscription effectuée ! Vous allez recevoir un e-mail vous permettant d\'activer votre compte');
            return $this->redirectToRoute('login');
        }

        return $this->render(
            'security/registration.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/inscription/confirmation/{token}", name="confim_register", requirements={"token" : ".+"}, methods={"GET"})
     */
    public function registerConfirmed(string $token)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var User|null $user */
        $user = $em->getRepository(User::class)->findOneBy(['confirmationToken' => $token]);
        if (null === $user) {
            throw new NotFoundHttpException(sprintf('L\'utilisateur avec le token "%s" n\'existe pas', $token));
        }
        $user->setConfirmationToken('');
        $user->setEmailConfirmed(true);
        $user->setIsActive(true);
        $em->persist($user);
        $em->flush();

        return $this->render('security/confirm.html.twig', array('user' => $user));
    }
}