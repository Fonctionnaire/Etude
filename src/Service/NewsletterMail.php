<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 04/07/2018
 * Time: 13:34
 */

namespace App\Service;


class NewsletterMail extends \Twig_Extension
{


    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendNewsletterMail($data, $email)
    {
        $message = (new \Swift_Message('De nouvelles études ont été publiés'))
            ->setFrom('newsletter@selonuneetude.fr')
            ->setTo([$email])
            ->setBody($this->twig->render(
                'emails/newsletterMail.html.twig',
                array(
                    'titre' => $data->getTitre()
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }

}