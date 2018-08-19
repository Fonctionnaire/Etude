<?php

namespace App\Controller\Security;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @Method({"GET", "POST"})
     */
    public function login(AuthenticationUtils $authUtils)
    {
        return $this->render('security/login.html.twig', [
            // last username entered by the user (if any)
            'last_username' => $authUtils->getLastUsername(),
            // last authentication error (if any)
            'error' => $authUtils->getLastAuthenticationError(),
        ]);
    }

    /**
     * This is the route the user can use to logout.
     *
     * But, this will never be executed. Symfony will intercept this first
     * and handle the logout automatically. See logout in config/packages/security.yaml
     *
     * @Route("/logout", name="security_logout")
     */
    public function logout(Response $response): void
    {
        $cookieName = $this->container->getParameter('framework.session.name');
        $response->headers->clearCookie( $cookieName );

        throw new \Exception('This should never be reached!');
    }
}