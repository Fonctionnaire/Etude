<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 06/05/2018
 * Time: 15:12
 */

namespace App\Controller\Etude;


use App\Entity\Commentaire\CommentaireEtude;
use App\Entity\Etude\Etude;
use App\Form\CommentaireEtudeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ViewEtudeController extends AbstractController
{

    /**
     * @Route("/etude/{slug}", name="view_etude")
     * @Method({"GET", "POST"})
     */
    public function viewEtude(Etude $etude, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sameCat = $em->getRepository(Etude::class)->findLastByCat($etude->getCategorie(), $etude->getSlug());

        $newComment = new CommentaireEtude();
        $form = $this->createForm(CommentaireEtudeType::class, $newComment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $newComment->setUser($this->getUser());
            $newComment->setEtude($etude);
            $em->persist($newComment);
            $em->flush();
            $this->addFlash('success', 'Votre commentaire a bien été ajouté.');
            return $this->redirectToRoute('view_etude', array(
                'slug' => $etude->getSlug(),
                'etude' => $etude,
            ));
        }

        return $this->render('etude/viewEtude.html.twig', array(
            'etude' => $etude,
            'sameCat' => $sameCat,
            'form' => $form->createView(),
        ));
    }
}