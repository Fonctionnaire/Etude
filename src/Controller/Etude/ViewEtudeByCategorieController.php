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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewEtudeByCategorieController extends AbstractController
{

    /**
     * @Route("/etudes/par-categorie/{slug}", name="view_etude_categorie")
     */
    public function viewEtudeByCat(Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $etudeByCat = $em->getRepository(Etude::class)->findByCat($categorie);
        $lastFive = $em->getRepository(Etude::class)->findLastFiveEtudes($categorie);

        return $this->render('etude/viewEtudeByCategorie.html.twig', array(
            'etudeByCat' => $etudeByCat,
            'lastFive' => $lastFive
        ));
    }
}