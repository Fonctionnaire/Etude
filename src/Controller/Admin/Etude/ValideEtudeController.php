<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 01/05/2018
 * Time: 16:15
 */

namespace App\Controller\Admin\Etude;


use App\Entity\Etude\Etude;
use App\Service\EtudeMail;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ValideEtudeController extends AbstractController
{

    /**
     * @Route("/admin/enable-etude/{slug}", name="admin_enable_etude")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function enableEtude(Etude $etude, EtudeMail $etudeMail)
    {
        $em = $this->getDoctrine()->getManager();
        $etude->setValide(true);
        $etude->setDateValidation(new \DateTime());
        $em->flush();
        if($etude->getUser())
        {
            $etudeMail->sendMailEtudeValide($etude->getUser(), $etude);
        }
        $this->addFlash('success', 'L\'étude à bien été validé');
        return $this->redirectToRoute('admin_gestion_etudes');
    }

    /**
     * @Route("/admin/disable-etude/{slug}", name="admin_disable_etude")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function disableEtude(Etude $etude)
    {
        $em = $this->getDoctrine()->getManager();
        $etude->setValide(false);
        $em->flush();
        $this->addFlash('success', 'L\'étude à bien été désactivé');
        return $this->redirectToRoute('admin_gestion_etudes');
    }
}