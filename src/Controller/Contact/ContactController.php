<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 25/05/2018
 * Time: 13:45
 */

namespace App\Controller\Contact;


use App\Form\ContactType;
use App\Service\ContactMail;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{

    /**
     * @Route("/nous-contacter", name="contact")
     */
    public function contact(Request $request, ContactMail $contactMail)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $contactMail->sendContactMail($data);
            $contactMail->sendContactMailToSender($data);
            $this->addFlash('success', 'Votre message a bien été envoyé ! Nous allons traiter votre demande au plus vite.');
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}