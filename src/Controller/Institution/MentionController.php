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

class MentionController extends AbstractController
{

    /**
     * @Route("/mentions-legales", name="mentions_legales")
     * @Method({"GET"})
     */
    public function mention()
    {

        return $this->render('institution/mentions.html.twig');
    }
}