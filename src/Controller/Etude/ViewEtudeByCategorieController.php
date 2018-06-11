<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 16/05/2018
 * Time: 16:48
 */

namespace App\Controller\Etude;


use App\Entity\Categorie\Categorie;
use App\Entity\Etude\Etude;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewEtudeByCategorieController extends AbstractController
{

    /**
     * @Route("/etudes/par-categorie/{slug}/{page}", defaults={"page": "1", "_format"="html"},
     *     name="view_etude_categorie")
     * @Method({"GET"})
     */
    public function viewEtudeByCat(Categorie $categorie, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $etudeByCat = $em->getRepository(Etude::class)->findByCat($categorie, $page);
        $lastFive = $em->getRepository(Etude::class)->findLastFiveEtudes($categorie);
        $nbPages = ceil(count($etudeByCat) / Etude::NB_ETUDES);
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }

        return $this->render('etude/viewEtudeByCategorie.html.twig', array(
            'etudeByCat' => $etudeByCat,
            'lastFive' => $lastFive,
            'nbPages' => $nbPages,
            'page' => $page,
            'categorie' => $categorie,
        ));
    }
}