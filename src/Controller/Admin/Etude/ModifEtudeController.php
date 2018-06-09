<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 08/06/2018
 * Time: 12:19
 */

namespace App\Controller\Admin\Etude;


use App\Entity\Etude\Etude;
use App\Form\EtudeType;
use App\Service\Slugger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ModifEtudeController extends AbstractController
{

    /**
     * @Route("/admin/etude/modifier/{slug}", name="admin_modif_etude")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function modifEtude(Etude $etude, Request $request, Slugger $slugger)
    {
        $form = $this->createForm(EtudeType::class, $etude);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $slug = $slugger->slugify($etude->getTitre());
            $etude->setSlug($slug);
            $etude->setSources($etude->getSources());
            $em->persist($etude);
            $em->flush();

            $this->addFlash('success', 'L\'étude a bien été modifié.');
            return $this->redirectToRoute('admin_view_etude', array(
                'etude' => $etude,
                'slug' => $etude->getSlug()
            ));
        }

        return $this->render('admin/etude/modifEtude.html.twig', array(
            'form' => $form->createView(),
            'etude' => $etude
        ));
    }
}