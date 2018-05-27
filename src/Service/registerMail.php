<?php

namespace App\Service;


class registerMail extends \Twig_Extension
{

    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer,\Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendRegisterMail($user)
    {
        $reply = $user->getEmail();
        $message = (new \Swift_Message('Confirmation d\'inscription'))
            ->setFrom('contact@ubimania.fr')
            ->setTo($reply)
            ->setBody($this->twig->render(
                'security/confirmMail.html.twig',
                array('user' => $user)
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }
}