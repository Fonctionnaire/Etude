<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 21/07/2018
 * Time: 12:57
 */

namespace App\Controller\Admin\Newsletter;


use App\Entity\Newsletter\Newsletter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListMailNewsletterController extends AbstractController
{

    /**
     * @Route("/admin/newsletter/liste-mail", name="admin_list_newsletter_mail")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function listMailNewsletter()
    {
        $em = $this->getDoctrine()->getManager();
        $listMail = $em->getRepository(Newsletter::class)->findAll();

        return $this->render('admin/newsletter/listMailNewsletter.html.twig', array(
            'listMail' => $listMail
        ));
    }

    /**
     * @Route("/admin/newsletter/list-mail/delete/{id}", name="admin_list_newsletter_mail_delete")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteMailNewsletter(Newsletter $newsletter)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($newsletter);
        $em->flush();

        $this->addFlash('success', 'Le mail a bien été supprimé');
        return $this->redirectToRoute('admin_list_newsletter_mail');
    }
}