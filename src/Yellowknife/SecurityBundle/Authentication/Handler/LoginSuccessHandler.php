<?php

namespace Yellowknife\SecurityBundle\Authentication\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface {

    protected
            $router,
            $security,
            $locale,
            $session;

    public function __construct(Router $router, SecurityContext $security, Session $session) {
        $this->router = $router;
        $this->security = $security;
        $this->session = $session;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
        // URL for redirect the user to where they were before the login process begun if you want.
        // $referer_url = $request->headers->get('referer');
        // Default target for unknown roles. Everyone else go there.
        $url = 'panel';

        if ($this->security->isGranted('ROLE_USER')) {
            $url = 'panel';
        } elseif ($this->security->isGranted('ROLE_ADMIN')) {
            $url = 'admin';
        }




        $response = new RedirectResponse($this->router->generate($url));

        return $response;
    }

    public function onInteractiveLogin(InteractiveLoginEvent $event) {
        $user = $event->getAuthenticationToken()->getUser();

        if (null !== $user->getLocale()) {
            $this->session->set('_locale', $user->getLocale());
        }
    }

}
