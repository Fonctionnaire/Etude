<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 02/06/2017
 * Time: 19:16
 */

namespace App\Service;




class ContactMail extends \Twig_Extension
{


    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendContactMail($data)
    {
        $message = (new \Swift_Message($data->getSujet()))
            ->setFrom('no-reply@selonuneetude.fr')
            ->setTo(['contact@selonuneetude.fr'])
            ->setBody($this->twig->render(
                'emails/contactMail.html.twig',
                array(
                    'pseudo' => $data->getPseudo(),
                    'email' => $data->getEmail(),
                    'sujet' => $data->getSujet(),
                    'texte' => $data->getTexte()
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }

    public function sendContactMailToSender($data)
    {
        $reply = $data->getEmail();
        $message = (new \Swift_Message('Nous avons bien reçu votre message'))
            ->setFrom('no-reply@selonuneetude.fr')
            ->setTo($reply)
            ->setBody($this->twig->render(
                'emails/contactMailForSender.html.twig',
                array(
                    'pseudo' => $data->getPseudo(),
                    'email' => $data->getEmail(),
                    'sujet' => $data->getSujet(),
                    'texte' => $data->getTexte()
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }
}
