<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 26/04/2018
 * Time: 15:35
 */

namespace App\Controller\Admin\Categorie;


use App\Entity\Categorie\Categorie;
use App\Form\CategorieType;
use App\Service\Slugger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AjoutCategorieController extends AbstractController
{

    /**
     * @Route("/admin/ajout-categorie", name="admin_ajout_categorie")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function ajouteCategorie(Request $request, Slugger $slugger)
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $slug = $slugger->slugify($categorie->getNom());
            $categorie->setSlug($slug);
            $em->persist($categorie);
            $em->flush();

            $this->addFlash('success', 'La catégorie a bien été ajouté');

            return $this->redirectToRoute('admin_gestion_categories');
        }

        return $this->render('admin/categorie/ajoutCategorie.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}