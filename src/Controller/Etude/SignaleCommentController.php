<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 23/06/2018
 * Time: 17:43
 */

namespace App\Controller\Etude;


use App\Entity\Commentaire\CommentaireEtude;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SignaleCommentController extends AbstractController
{

    /**
     * @Route("/signaler-un-commentaire/{id}", name="etude_signale_comment")
     * @Method({"GET", "POST"})
     */
    public function signaleComment(CommentaireEtude $comment)
    {
        $em = $this->getDoctrine()->getManager();
        $comment->setSignale(true);
        $em->flush();

        $this->addFlash('success', 'Le commentaire a bien été slignalé.');

        return $this->redirectToRoute('view_etude', array(
            'slug' => $comment->getEtude()->getSlug(),
        ));
    }
}