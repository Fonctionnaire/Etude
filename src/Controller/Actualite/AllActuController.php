<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 22/05/2018
 * Time: 12:36
 */

namespace App\Controller\Actualite;


use App\Entity\Actualite\Actualite;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AllActuController extends AbstractController
{

    /**
     * @Route("/actualites/{page}", defaults={"page": "1", "_format"="html"},name="all_actualites")
     * @Method({"GET"})
     */
    public function allActu($page)
    {

        $em = $this->getDoctrine()->getManager();
        $allActu = $em->getRepository(Actualite::class)->findActualitesPaginated($page);
        $nbPages = ceil(count($allActu) / Actualite::NB_ACTU);
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }

        return $this->render('actualite/allActu.html.twig', array(
            'allActu' => $allActu,
            'nbPages' => $nbPages,
            'page' => $page,
        ));
    }
}