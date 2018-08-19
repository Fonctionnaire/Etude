<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 16/06/2018
 * Time: 17:31
 */

namespace App\Controller\Admin\Categorie;


use App\Entity\Categorie\CategoriesImage;
use App\Form\CategoriesImageType;
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AjoutImageController extends AbstractController
{

    /**
     * @Route("/admin/ajout-categorie-image", name="admin_ajout_categorie_image")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function ajoutImage(Request $request, FileUploader $fileUploader)
    {
        $catImage = new CategoriesImage();
        $form = $this->createForm(CategoriesImageType::class, $catImage);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $file = $form['image']->getData();
            $fileName = $fileUploader->upload($file);
            $catImage->setImage($fileName);
            $em->persist($catImage);
            $em->flush();
            $this->addFlash('success', 'L\'image a bien été ajouté.');
            return $this->redirectToRoute('admin_gestion_categories');
        }

        return $this->render('admin/categorie/ajoutImage.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}