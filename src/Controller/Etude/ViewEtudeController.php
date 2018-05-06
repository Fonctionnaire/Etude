<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 06/05/2018
 * Time: 15:12
 */

namespace App\Controller\Etude;


use App\Entity\Etude\Etude;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewEtudeController extends AbstractController
{

    /**
     * @Route("/etude/{slug}", name="view_etude")
     */
    public function viewEtude(Etude $etude)
    {

        return $this->render('etude/viewEtude.html.twig', array(
            'etude' => $etude,
        ));
    }
}