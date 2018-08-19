<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 23/06/2018
 * Time: 18:23
 */

namespace App\Controller\Admin\Commentaires;


use App\Entity\Commentaire\CommentaireActu;
use App\Entity\Commentaire\CommentaireEtude;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionCommentsController extends AbstractController
{

    /**
     * @Route("/admin/gestion-commentaires/etude", name="admin_gestion_comments_etude")
     * @Method({"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function gestionCommentsEtude()
    {
        $em = $this->getDoctrine()->getManager();
        $signaleComments = $em->getRepository(CommentaireEtude::class)->findSignaleComments();

        return $this->render('admin/commentaires/gestionCommentairesEtude.html.twig', array(
            'signaleComments' => $signaleComments,
        ));
    }

    /**
     * @Route("/admin/gestion-commentaires/actualite", name="admin_gestion_comments_actu")
     * @Method({"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function gestionCommentsActu()
    {
        $em = $this->getDoctrine()->getManager();
        $signaleComments = $em->getRepository(CommentaireActu::class)->findSignaleComments();

        return $this->render('admin/commentaires/gestionCommentairesActu.html.twig', array(
            'signaleComments' => $signaleComments,
        ));
    }

    /**
     * @Route("/admin/gestion-commentaire/etude/activer/{id}", name="admin_gestion_comments_etude_enable")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function activerCommentsEtude(CommentaireEtude $commentaireEtude)
    {
        $em = $this->getDoctrine()->getManager();
        $commentaireEtude->setActif(true);
        $em->flush();
        $this->addFlash('success', 'Le commentaire a bien été activé.');
        return $this->redirectToRoute('admin_gestion_comments_etude');
    }

    /**
     * @Route("/admin/gestion-commentaire/etude/desactiver/{id}", name="admin_gestion_comments_etude_disable")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function desactiverCommentsEtude(CommentaireEtude $commentaireEtude)
    {
        $em = $this->getDoctrine()->getManager();
        $commentaireEtude->setActif(false);
        $em->flush();
        $this->addFlash('success', 'Le commentaire a bien été désactivé.');
        return $this->redirectToRoute('admin_gestion_comments_etude');
    }

    /**
     * @Route("/admin/gestion-commentaire/actualite/activer/{id}", name="admin_gestion_comments_actu_enable")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function activerCommentsActu(CommentaireActu $commentaireActu)
    {
        $em = $this->getDoctrine()->getManager();
        $commentaireActu->setActif(true);
        $em->flush();
        $this->addFlash('success', 'Le commentaire a bien été activé.');
        return $this->redirectToRoute('admin_gestion_comments_actu');
    }

    /**
     * @Route("/admin/gestion-commentaire/actualite/desactiver/{id}", name="admin_gestion_comments_actu_disable")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function desactiverCommentsActu(CommentaireActu $commentaireActu)
    {
        $em = $this->getDoctrine()->getManager();
        $commentaireActu->setActif(false);
        $em->flush();
        $this->addFlash('success', 'Le commentaire a bien été désactivé.');
        return $this->redirectToRoute('admin_gestion_comments_actu');
    }
}