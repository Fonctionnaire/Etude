<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 29/04/2018
 * Time: 13:27
 */

namespace App\Controller\Admin\Actualite;


use App\Entity\Actualite\Actualite;
use App\Form\ActualiteType;
use App\Service\Slugger;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AjoutActualiteController extends AbstractController
{

    /**
     * @Route("/admin/ajout-actualite", name="admin_ajout_actualite")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function ajoutActualite(Request $request, Slugger $slugger)
    {
        $actu = new Actualite();
        $form = $this->createForm(ActualiteType::class, $actu);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $slug = $slugger->slugify($actu->getTitre());
            $actu->setSlug($slug);
            $em->persist($actu);
            $em->flush();

            $this->addFlash('success', 'L\'actualité a bien été publié');
            return $this->redirectToRoute('admin_gestion_actualite');
        }

        return $this->render('admin/actualite/ajoutActualite.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}