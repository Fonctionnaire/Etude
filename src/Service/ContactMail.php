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
        $reply = $data['email'];
        $message = (new \Swift_Message('Contact'))
            ->setFrom('gruffy.thibaut@gmail.com')
            ->setTo(['thibaut.gruffy@gmail.com', $reply])
            ->setBody($this->twig->render(
                'emails/contactMail.html.twig',
                array(
                    'pseudo' => $data['pseudo'],
                    'email' => $data['email'],
                    'sujet' => $data['sujet'],
                    'texte' => $data['texte']
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }

    public function sendContactMailToSender($data)
    {
        $reply = $data['email'];
        $message = (new \Swift_Message('Contact'))
            ->setFrom('gruffy.thibaut@gmail.com')
            ->setTo($reply)
            ->setBody($this->twig->render(
                'emails/contactMailForSender.html.twig',
                array(
                    'pseudo' => $data['pseudo'],
                    'email' => $data['email'],
                    'sujet' => $data['sujet'],
                    'texte' => $data['texte']
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }
}
