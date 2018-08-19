<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 04/07/2018
 * Time: 12:17
 */

namespace App\Controller\Admin\Newsletter;


use App\Entity\Newsletter\Newsletter;
use App\Entity\Newsletter\SendNewsletter;
use App\Form\SendNewsletterType;
use App\Service\NewsletterMail;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class NewsletterController extends AbstractController
{

    /**
     * @Route("/admin/envoi-newsletter", name="admin_envoi_newsletter")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function sendNewsletter(Request $request, NewsletterMail $newsletterMail)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(Newsletter::class)->findAll();
        $newsletter = new SendNewsletter();
        $form = $this->createForm(SendNewsletterType::class, $newsletter);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            foreach ($users as $user)
            {
               $newsletterMail->sendNewsletterMail($form->getData(), $user->getEmail());
            }
            $em->persist($newsletter);
            $em->flush();
            $this->addFlash('success', 'La newsletter a bien été envoyé !');
            return $this->redirectToRoute('admin_envoi_newsletter');
        }

        return $this->render('admin/newsletter/sendNewsletter.html.twig', array(
            'form' => $form->createView()
        ));
    }
}