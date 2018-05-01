<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 26/04/2018
 * Time: 13:25
 */

namespace App\Controller\Admin\Etude;


use App\Entity\Etude\Etude;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionEtudesController extends AbstractController
{

    /**
     * @Route("/admin/gestion-etudes", name="admin_gestion_etudes")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function gestionEtudes()
    {
        $em = $this->getDoctrine()->getManager();
        $etudes = $em->getRepository(Etude::class)->findAll();

        return $this->render('admin/etude/gestionEtudes.html.twig', array(
            'etudes' => $etudes,
        ));
    }
}