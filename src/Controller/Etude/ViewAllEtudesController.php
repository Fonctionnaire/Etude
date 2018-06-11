<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 09/06/2018
 * Time: 18:06
 */

namespace App\Controller\Etude;


use App\Entity\Etude\Etude;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewAllEtudesController extends AbstractController
{

    /**
     * @Route("/etudes/{page}", defaults={"page": "1", "_format"="html"} ,name="view_all_etudes")
     * @Method({"GET"})
     */
    public function viewAllEtudes($page)
    {

        $em = $this->getDoctrine()->getManager();
        $etudes = $em->getRepository(Etude::class)->findEtudesPaginated($page);
        $nbPages = ceil(count($etudes) / Etude::NB_ETUDES);
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }
        return $this->render('etude/viewAllEtudes.html.twig', array(
            'etudes' => $etudes,
            'nbPages' => $nbPages,
            'page' => $page,
        ));
    }
}