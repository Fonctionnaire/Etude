<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 29/04/2018
 * Time: 13:27
 */

namespace App\Controller\Admin\Actualite;


use App\Entity\Actualite\Actualite;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionActualiteController extends AbstractController
{

    /**
     * @Route("/admin/gestion-actualite", name="admin_gestion_actualite")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function gestionActualite()
    {
        $em = $this->getDoctrine()->getManager();
        $actus = $em->getRepository(Actualite::class)->findAll();
        return $this->render('admin/actualite/gestionActualite.html.twig', array(
            'actus' => $actus,
        ));
    }
}