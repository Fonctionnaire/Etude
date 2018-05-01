<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 01/05/2018
 * Time: 17:08
 */

namespace App\Controller\Admin\Utilisateur;


use App\Entity\User\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteUserController extends AbstractController
{

    /**
     * @Route("/admin/delete-user/{username}", name="admin_delete_user")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteUser(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'L\'utilisateur a bien été supprimé');

        return $this->redirectToRoute('admin_gestion_utilisateurs');
    }
}