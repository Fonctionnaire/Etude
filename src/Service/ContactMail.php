<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 02/06/2017
 * Time: 19:16
 */

namespace App\Service;




class ContactMail
{


    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendContactMail($data)
    {
        $reply = $data['mail'];
        $message = (new \Swift_Message('Contact'))
            ->setFrom('gruffy.thibaut@gmail.com')
            ->setTo(['thibaut.gruffy@gmail.com', $reply])
            ->setBody($this->renderView(
                ':Emails:contactMail.html.twig',
                array(
                    'name' => $data['name'],
                    'firstName' => $data['firstName'],
                    'mail' => $data['mail'],
                    'subject' => $data['subject'],
                    'message' => $data['message']
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }

    public function sendContactMailToSender($data)
    {
        $reply = $data['mail'];
        $message = (new \Swift_Message('Contact'))
            ->setFrom('gruffy.thibaut@gmail.com')
            ->setTo($reply)
            ->setBody($this->renderView(
                ':Emails:contactMailForSender.html.twig',
                array(
                    'name' => $data['name'],
                    'firstName' => $data['firstName'],
                    'mail' => $data['mail'],
                    'subject' => $data['subject'],
                    'message' => $data['message']
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }
}
