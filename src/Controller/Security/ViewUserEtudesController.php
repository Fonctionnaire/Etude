<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 10/05/2018
 * Time: 13:44
 */

namespace App\Controller\Security;


use App\Entity\Etude\Etude;
use App\Entity\User\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewUserEtudesController extends AbstractController
{

    /**
     * @Route("/etude/{username}/{slug}", name="view_user_etude")
     * @Security("has_role('ROLE_USER')")
     */
    public function viewUserEtudes(User $user, Etude $etude)
    {
        $this->denyAccessUnlessGranted('view', $user);

        return $this->render('security/viewEtude.html.twig', array(
            'user' => $user,
            'etude' => $etude,
        ));
    }

}