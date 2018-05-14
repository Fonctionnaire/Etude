<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 09/05/2018
 * Time: 16:14
 */

namespace App\Controller\Admin\Etude;


use App\Entity\Etude\Etude;
use App\Form\MotifRefus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ViewEtudeController extends AbstractController
{

    /**
     * @Route("/admin/etude/{slug}", name="admin_view_etude")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function viewEtude(Etude $etude, Request $request)
    {
        $form = $this->createForm(MotifRefus::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $etude->setRefuse(true);
            $etude->setValide(false);
            $data = $form->getData();
            $etude->setMotifRefus($data['motifRefus']);
            // PREVOIR L'ENVOI DE MAIL
            $em->flush();
            $this->addFlash('success', 'L\'étude a bien été refusé');

            return $this->redirectToRoute('admin_gestion_etudes');
        }

        return $this->render('admin/etude/viewEtude.html.twig', array(
            'etude' => $etude,
            'form' => $form->createView(),
        ));
    }
}