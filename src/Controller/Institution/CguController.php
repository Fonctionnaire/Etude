<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 11/06/2018
 * Time: 15:00
 */

namespace App\Controller\Institution;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CguController extends AbstractController
{

    /**
     * @Route("/conditions-generales-utilisation", name="conditions_utilisation")
     * @Method({"GET"})
     */
    public function cgu()
    {

        return $this->render('institution/cgu.html.twig');
    }
}