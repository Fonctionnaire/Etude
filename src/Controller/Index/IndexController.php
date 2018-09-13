<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 17/03/2018
 * Time: 12:39
 */

namespace App\Controller\Index;


use App\Entity\Actualite\Actualite;
use App\Entity\Categorie\Categorie;
use App\Entity\Etude\Etude;
use App\Entity\Newsletter\Newsletter;
use App\Form\NewsletterType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{

    /**
     * @Route("/", name="index")
     *
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $lastEtudes = $em->getRepository(Etude::class)->findLastTwentyEtude();
        $lastActu = $em->getRepository(Actualite::class)->findLastActu();
        $categories = $em->getRepository(Categorie::class)->findAll();
        $lastEtude = $em->getRepository(Etude::class)->findLastEtudeValide();
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

        return $this->render('index/index.html.twig', array(
            'lastEtudes' => $lastEtudes,
            'lastActu' => $lastActu,
            'categories' => $categories,
            'lastEtude' => $lastEtude,
            'form' => $form->createView()
        ));
    }
}