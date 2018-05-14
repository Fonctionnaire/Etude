<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 06/05/2018
 * Time: 15:49
 */

namespace App\Controller\Etude;


use App\Entity\Etude\Etude;
use App\Form\EtudeType;
use App\Service\EtudeAddUser;
use App\Service\Slugger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProposerEtudeController extends AbstractController
{

    /**
     * @Route("/proposer-etude", name="proposer_etude")
     */
    public function proposerEtude(Request $request, Slugger $slugger, EtudeAddUser $etudeAddUser)
    {

        $etude = new Etude();
        $form = $this->createForm(EtudeType::class, $etude);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $slug = $slugger->slugify($etude->getTitre());
            $etude->setUser($etudeAddUser->EtudeAddUser());
            foreach ($etude->getSources() as $sources)
            {
                $sources->setEtude($etude);
            }
            $etude->setSlug($slug);
            $em->persist($etude);
            $em->flush();

            $this->addFlash('success', 'Votre étude a bien été soumise. Nous allons la traiter au plus vite !');
            return $this->redirectToRoute('index');
        }

        return $this->render('etude/proposerEtude.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}