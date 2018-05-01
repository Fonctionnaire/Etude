<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 01/05/2018
 * Time: 17:58
 */

namespace App\Controller\Admin\Categorie;


use App\Entity\Categorie\Categorie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteCategorieController extends AbstractController
{

    /**
     * @Route("/admin/delete-categorie/{slug}", name="admin_delete_categorie")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteCategorie(Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();
        $this->addFlash('success', 'La catégorie a bien été supprimé');

        return $this->redirectToRoute('admin_gestion_categories');
    }
}