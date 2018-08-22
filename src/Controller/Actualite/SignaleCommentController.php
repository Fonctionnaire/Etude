<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 22/08/2018
 * Time: 17:15
 */

namespace App\Controller\Actualite;


use App\Entity\Commentaire\CommentaireActu;
use App\Entity\Commentaire\CommentaireEtude;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SignaleCommentController extends AbstractController
{

    /**
     * @Route("/signaler-commentaire-actu/{id}", name="actu_signale_comment")
     * @Method({"GET", "POST"})
     */
    public function signaleComment(CommentaireActu $comment)
    {
        $em = $this->getDoctrine()->getManager();
        $comment->setSignale(true);
        $em->flush();

        $this->addFlash('success', 'Le commentaire a bien été slignalé.');

        return $this->redirectToRoute('view_one_actu', array(
            'slug' => $comment->getActu()->getSlug(),
        ));
    }
}