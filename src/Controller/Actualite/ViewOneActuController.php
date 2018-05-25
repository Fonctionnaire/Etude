<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 22/05/2018
 * Time: 12:43
 */

namespace App\Controller\Actualite;


use App\Entity\Actualite\Actualite;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewOneActuController extends AbstractController
{

    /**
     * @Route("/actulites/{slug}", name="view_one_actu")
     */
    public function viewOneActu(Actualite $actualite)
    {

        return $this->render('actualite/viewOneActu.html.twig', array(
            'actualite' => $actualite,
        ));
    }
}