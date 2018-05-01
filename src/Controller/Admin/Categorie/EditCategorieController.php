<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 01/05/2018
 * Time: 18:01
 */

namespace App\Controller\Admin\Categorie;


use App\Entity\Categorie\Categorie;
use App\Form\CategorieType;
use App\Service\Slugger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class EditCategorieController extends AbstractController
{

    /**
     * @Route("/admin/edit-categorie/{slug}", name="admin_edit_categorie")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editCategorie(Categorie $categorie, Request $request, Slugger $slugger)
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $slug = $slugger->slugify($categorie->getNom());
            $categorie->setSlug($slug);
            $em->flush();

            $this->addFlash('success', 'La categorie ' . $categorie->getNom() . ' a bien été modifié.');
            return $this->redirectToRoute('admin_gestion_categories');
        }

        return $this->render('admin/categorie/editCategorie.html.twig', array(
            'form' => $form->createView()
        ));
    }
}