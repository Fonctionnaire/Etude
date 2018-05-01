<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 01/05/2018
 * Time: 17:11
 */

namespace App\Controller\Admin\Utilisateur;


use App\Entity\User\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ValideUserController extends AbstractController
{

    /**
     * @Route("/admin/enable-user/{username}", name="admin_enable_user")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function enableUser(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $user->setIsActive(true);
        $em->flush();

        $this->addFlash('success', 'L\'utilisateur ' . $user->getUsername() . ' a bien été activé');

        return $this->redirectToRoute('admin_gestion_utilisateurs');
    }

    /**
     * @Route("/admin/disable-user/{username}", name="admin_disable_user")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function disableUser(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $user->setIsActive(false);
        $em->flush();

        $this->addFlash('success', 'L\'utilisateur ' . $user->getUsername() . ' a bien été désactivé');

        return $this->redirectToRoute('admin_gestion_utilisateurs');
    }
}