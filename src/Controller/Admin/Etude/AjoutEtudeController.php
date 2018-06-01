<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 26/04/2018
 * Time: 13:24
 */

namespace App\Controller\Admin\Etude;


use App\Entity\Etude\Etude;
use App\Form\EtudeType;
use App\Service\Slugger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AjoutEtudeController extends AbstractController
{

    /**
     * @Route("/admin/ajout-etude", name="admin_ajout_etude")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function ajoutEtude(Request $request, Slugger $slugger)
    {

        $etude = new Etude();
        $form = $this->createForm(EtudeType::class, $etude);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $slug = $slugger->slugify($etude->getTitre());
            $etude->setSlug($slug);

            $etude->setUser($this->getUser()->getUsername());
            $em->persist($etude);
            $em->flush();

            $this->addFlash('success', 'L\'étude a bien été ajouté');
            return $this->redirectToRoute('admin_gestion_etudes');
        }

        return $this->render('admin/etude/ajoutEtude.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}