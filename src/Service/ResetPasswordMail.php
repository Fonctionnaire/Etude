<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 27/05/2018
 * Time: 13:37
 */

namespace App\Service;


class ResetPasswordMail extends \Twig_Extension
{

    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer,\Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendResetPasswordMail($user)
    {

        $message = (new \Swift_Message('Changement de mot de passe'))
            ->setFrom('no-reply@selonuneetude.fr')
            ->setTo($user->getEmail())
            ->setBody($this->twig->render(
                'emails/resetPasswordMail.html.twig', array(
                    'user' => $user,
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }
}