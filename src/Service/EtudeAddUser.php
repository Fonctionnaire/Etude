<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 07/05/2018
 * Time: 13:59
 */

namespace App\Service;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudeAddUser extends AbstractController
{
    public function EtudeAddUser()
    {
        if($this->isGranted('IS_AUTHENTICATED_REMEMBERED') || $this->isGranted('IS_AUTHENTICATED_FULLY')){
            return $this->getUser();
        }else{
            return null;
        }
    }
}