<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 09/06/2018
 * Time: 18:06
 */

namespace App\Controller\Etude;


use App\Entity\Etude\Etude;
use App\Entity\Newsletter\Newsletter;
use App\Form\NewsletterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ViewAllEtudesController extends AbstractController
{

    /**
     * @Route("/etudes/{page}", defaults={"page": "1", "_format"="html"} ,name="view_all_etudes")
     * @Method({"GET"})
     */
    public function viewAllEtudes($page, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $etudes = $em->getRepository(Etude::class)->findEtudesPaginated($page);
        $nbPages = ceil(count($etudes) / Etude::NB_ETUDES);
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($newsletter);
            $em->flush();
            $this->addFlash('success', 'Vous êtes maintenant inscrit à la newsletter !');
            return $this->redirectToRoute('index');
        }

        return $this->render('etude/viewAllEtudes.html.twig', array(
            'etudes' => $etudes,
            'nbPages' => $nbPages,
            'page' => $page,
            'form' => $form->createView()
        ));
    }
}