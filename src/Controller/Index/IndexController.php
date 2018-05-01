<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 17/03/2018
 * Time: 12:39
 */

namespace App\Controller\Index;


use App\Entity\Actualite\Actualite;
use App\Entity\Etude\Etude;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{

    /**
     * @Route("/", name="index")
     *
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $lastEtudes = $em->getRepository(Etude::class)->findLastTenEtude();
        $lastActu = $em->getRepository(Actualite::class)->findLastActu();

        return $this->render('index/index.html.twig', array(
            'lastEtudes' => $lastEtudes,
            'lastActu' => $lastActu,
        ));
    }
}