<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 26/06/2018
 * Time: 12:10
 */

namespace App\Controller\Security;


use App\Entity\User\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SuppCompteController extends AbstractController
{

    /**
     * @Route("/profil/{username}/supprimer-mes-informations", name="view_profile_infos_delete")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function pageSuppCompte(User $user)
    {
        $this->denyAccessUnlessGranted('view', $user);

        return $this->render('security/supprCompte.html.twig');
    }

    /**
     * @Route("/profil/{username}/supprimer-mes-informations/suppression", name="view_profile_delete")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function SupprCompte(User $user)
    {
        $this->denyAccessUnlessGranted('view', $user);

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'Vos informations personnelles ont bien été supprimées.');
        return $this->redirectToRoute('index');
    }
}