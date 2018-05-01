<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 01/05/2018
 * Time: 16:12
 */

namespace App\Controller\Admin\Etude;


use App\Entity\Etude\Etude;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteEtudeController extends AbstractController
{

    /**
     * @Route("/admin/delete-etude/{slug}", name="admin_delete_etude")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteEtude(Etude $etude)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($etude);
        $em->flush();

        $this->addFlash('success', 'L\'étude a bien été supprimé');

        return $this->redirectToRoute('admin_gestion_etudes');
    }
}