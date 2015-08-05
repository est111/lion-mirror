<?php

namespace Yellowknife\SecurityBundle\EventListener;

use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

/**
 * Description of LoginListener
 *
 * @author Karol Gontarski
 */
class LoginListener {

    /** @var \Symfony\Component\Security\Core\SecurityContext */
    private $securityContext;

    /** @var \Doctrine\ORM\EntityManager */
    private $em;

    private $locale;
    
    private $user;


    /**
     * Constructor
     * 
     * @param SecurityContext $securityContext
     * @param Doctrine        $doctrine
     */
    public function __construct(SecurityContext $securityContext, Doctrine $doctrine) {
        $this->securityContext = $securityContext;
        $this->em = $doctrine->getEntityManager();
    }

    /**
     * Do the magic.
     * 
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event) {
        if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            // user has just logged in
        }

        if ($this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            // user has logged in using remember_me cookie
        }

        // do some other magic here
        $this->user = $event->getAuthenticationToken()->getUser();

        // ...
    }

    public function onKernelResponse(FilterResponseEvent $event) {

        if (null !== $this->locale) {
            $request = $event->getRequest();
            $request->getSession()->set('_locale', $this->locale);
        }
    }

}
