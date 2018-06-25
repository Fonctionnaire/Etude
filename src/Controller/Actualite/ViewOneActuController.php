<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 22/05/2018
 * Time: 12:43
 */

namespace App\Controller\Actualite;


use App\Entity\Actualite\Actualite;
use App\Entity\Commentaire\CommentaireActu;
use App\Form\CommentaireActuType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ViewOneActuController extends AbstractController
{

    /**
     * @Route("/actualites-{slug}", name="view_one_actu")
     */
    public function viewOneActu(Actualite $actualite, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $fiveActu = $em->getRepository(Actualite::class)->findLastFiveActu($actualite->getSlug());
        $newComment = new CommentaireActu();
        $form = $this->createForm(CommentaireActuType::class, $newComment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $newComment->setUser($this->getUser());
            $newComment->setActu($actualite);
            $em->persist($newComment);
            $em->flush();
            $this->addFlash('success', 'Votre commentaire a bien été ajouté.');
            return $this->redirectToRoute('view_one_actu', array(
                'slug' => $actualite->getSlug(),
                'actualite' => $actualite
            ));
        }
        return $this->render('actualite/viewOneActu.html.twig', array(
            'actualite' => $actualite,
            'fiveActu' => $fiveActu,
            'form' => $form->createView(),
        ));
    }
}