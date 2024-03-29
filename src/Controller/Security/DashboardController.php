<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 23/11/2017
 * Time: 13:23
 */

namespace App\Controller\Security;



use App\Entity\User\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/profil/{username}", name="view_profile")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function viewProfileAction(User $user)
    {
        $this->denyAccessUnlessGranted('view', $user);

        return $this->render('security/dashboard.html.twig', array(
            'user' => $user,
        ));

    }

}