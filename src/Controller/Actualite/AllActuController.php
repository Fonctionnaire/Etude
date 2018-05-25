<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 22/05/2018
 * Time: 12:36
 */

namespace App\Controller\Actualite;


use App\Entity\Actualite\Actualite;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AllActuController extends AbstractController
{

    /**
     * @Route("/actualites", name="all_actualites")
     */
    public function allActu()
    {

        $em = $this->getDoctrine()->getManager();
        $allActu = $em->getRepository(Actualite::class)->findAll();

        return $this->render('actualite/allActu.html.twig', array(
            'allActu' => $allActu,
        ));
    }
}