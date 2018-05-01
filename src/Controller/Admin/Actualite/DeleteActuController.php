<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 30/04/2018
 * Time: 14:20
 */

namespace App\Controller\Admin\Actualite;


use App\Entity\Actualite\Actualite;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteActuController extends AbstractController
{

    /**
     * @Route("/admin/supprimer-actualite/{slug}", name="admin_delete_actu")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteActu(Actualite $actualite)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($actualite);
        $em->flush();

        $this->addFlash('success', 'L\'actualité a bien été supprimé');

        return $this->redirectToRoute('admin_gestion_actualite');
    }
}