<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 26/04/2018
 * Time: 15:35
 */

namespace App\Controller\Admin\Categorie;


use App\Entity\Categorie\Categorie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionCategoriesController extends AbstractController
{

    /**
     * @Route("/admin/gestion-categories", name="admin_gestion_categories")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function gestionCategories()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Categorie::class)->findAll();

        return $this->render('admin/categorie/gestionCategories.html.twig', array(
            'categories' => $categories,
        ));
    }
}