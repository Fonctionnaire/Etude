<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 01/05/2018
 * Time: 16:56
 */

namespace App\Controller\Admin\Utilisateur;


use App\Entity\User\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionUtilisateursController extends AbstractController
{

    /**
     * @Route("/admin/gestion-utilisateurs", name="admin_gestion_utilisateurs")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function gestionUtilisateurs()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findAll();

        return $this->render('admin/utilisateur/gestionUtilisateurs.html.twig', array(
            'users' => $users,
        ));
    }
}