<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/06/2018
 * Time: 13:55
 */

namespace App\Controller\Rss;


use App\Entity\Etude\Etude;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudeRssController extends AbstractController
{

    /**
     * @Route("/etudes-rss/rss.{_format}", name="etudes_rss", requirements={"_format" = "xml"})
     * @Method({"GET"})
     */
    public function etudeRss()
    {
        $em = $this->getDoctrine()->getManager();
        $etudes = $em->getRepository(Etude::class)->findAllEtudesValide();
        return $this->render('rss/etudeRss.xml.twig', array(
            'etudes' => $etudes,
        ));
    }
}