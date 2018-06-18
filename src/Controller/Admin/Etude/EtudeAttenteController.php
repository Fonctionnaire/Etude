<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/06/2018
 * Time: 16:54
 */

namespace App\Controller\Admin\Etude;


use App\Entity\Etude\Etude;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudeAttenteController extends AbstractController
{

    /**
     * @Route("/admin/gestion-etudes-attente", name="admin_gestion_etudes_attente")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function etudeAttente()
    {
        $em = $this->getDoctrine()->getManager();
        $etudeAttente = $em->getRepository(Etude::class)->findEtudeNonValide();

        return $this->render('admin/etude/etudeAttente.html.twig', array(
            'etudeAttente' => $etudeAttente,
        ));
    }
}