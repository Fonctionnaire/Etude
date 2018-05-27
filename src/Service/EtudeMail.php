<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 26/05/2018
 * Time: 17:11
 */

namespace App\Service;


class EtudeMail extends \Twig_Extension
{

    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendMailEtudeModeration($user, $etude)
    {
        $reply = $user->getEmail();
        $message = (new \Swift_Message('Etude en attente de modération'))
            ->setFrom('no-reply@selonuneetude.fr')
            ->setTo($reply)
            ->setBody($this->twig->render(
                'emails/etudeModerationMail.html.twig',
                array(
                    'user' => $user,
                    'titre' => $etude->getTitre()
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }

    public function sendMailEtudeValide($user, $etude)
    {
        $reply = $user->getEmail();
        $message = (new \Swift_Message('Votre étude est validée'))
            ->setFrom('no-reply@selonuneetude.fr')
            ->setTo($reply)
            ->setBody($this->twig->render(
                'emails/etudeValideMail.html.twig',
                array(
                    'user' => $user,
                    'titre' => $etude->getTitre()
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }

    public function sendMailEtudeRefuse($user, $etude)
    {
        $reply = $user->getEmail();
        $message = (new \Swift_Message('Votre étude a été refusé'))
            ->setFrom('no-reply@selonuneetude.fr')
            ->setTo($reply)
            ->setBody($this->twig->render(
                'emails/etudeRefuseMail.html.twig',
                array(
                    'user' => $user,
                    'titre' => $etude->getTitre(),
                    'motifRefus' => $etude->getMotifRefus()
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }
}