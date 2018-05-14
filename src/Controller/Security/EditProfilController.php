<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 05/05/2018
 * Time: 12:40
 */

namespace App\Controller\Security;


use App\Entity\User\User;
use App\Form\UserEditMdpType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EditProfilController extends AbstractController
{

    /**
     * @Route("/profil/{username}/editer-email", name="edit_profile_email")
     * @Security("has_role('ROLE_USER')")
     */
    public function editProfilMail(User $user, Request $request)
    {
        $this->denyAccessUnlessGranted('edit', $user);
        $form = $this->createForm('App\Form\UserEditMailType');
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();
            $user->setEmail($data['newEmail']);
            $em->flush();
            $this->addFlash('success', 'Votre e-mail a bien été édité.');
            return $this->redirectToRoute('view_profile', array(
                'username' => $user->getUsername(),
            ));
        }

        return $this->render('security/editProfileMail.html.twig', array(
            'user' => $user,
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/profil/{username}/editer-mdp", name="edit_profile_mdp")
     * @Security("has_role('ROLE_USER')")
     */
    public function editProfilMdp(User $user, Request $request, UserPasswordEncoderInterface $userPasswordEncoder)
    {

        $this->denyAccessUnlessGranted('edit', $user);

        $form = $this->createForm(UserEditMdpType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $password = $userPasswordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em->persist($user);
            $em->flush();
            // Envoi de mail de confirmation
            $this->addFlash('success', 'Votre mot de passe a bien été édité.');
            return $this->redirectToRoute('view_profile', array(
                'username' => $user->getUsername()
            ));
        }

        return $this->render('security/editProfilMdp.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }
}