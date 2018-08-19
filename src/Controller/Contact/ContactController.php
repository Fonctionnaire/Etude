<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 25/05/2018
 * Time: 13:45
 */

namespace App\Controller\Contact;


use App\Entity\Contact\Contact;
use App\Form\ContactType;
use App\Service\ContactMail;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{

    /**
     * @Route("/nous-contacter", name="contact")
     */
    public function contact(Request $request, ContactMail $contactMail)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $contactMail->sendContactMail($contact);
            $contactMail->sendContactMailToSender($contact);
            $this->addFlash('success', 'Votre message a bien été envoyé ! Nous allons traiter votre demande au plus vite.');
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}