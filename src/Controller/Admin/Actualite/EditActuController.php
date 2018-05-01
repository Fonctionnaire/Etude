<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 30/04/2018
 * Time: 14:20
 */

namespace App\Controller\Admin\Actualite;


use App\Entity\Actualite\Actualite;
use App\Form\ActualiteType;
use App\Service\Slugger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class EditActuController extends AbstractController
{

    /**
     * @Route("/admin/edit-actualite/{slug}", name="admin_edit_actualite")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editActu(Actualite $actualite, Request $request, Slugger $slugger)
    {
        $form = $this->createForm(ActualiteType::class, $actualite);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $slug = $slugger->slugify($actualite->getTitre());
            $actualite->setSlug($slug);
            $em->flush();

            $this->addFlash('success', 'L\'actualité a bien été modifié');

            return $this->redirectToRoute('admin_gestion_actualite');
        }

        return $this->render('admin/actualite/editActualite.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}