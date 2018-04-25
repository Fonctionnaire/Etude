<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 17/03/2018
 * Time: 12:39
 */

namespace App\Controller\Index;


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
        return $this->render('index/index.html.twig');
    }
}