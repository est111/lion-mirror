<?php

namespace Yellowknife\SecurityBundle\EventListener;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

/**
 * Stores the locale of the user in the session after the
 * login. This can be used by the LocaleListener afterwards.
 */
class UserLocaleListener
{
    /**
     * @var Session
     */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param InteractiveLoginEvent $event
     */
    public function onInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        
        
        if (get_class($user) == "Symfony\Component\Security\Core\User\User" ) 
        {
            $locale = "en";
        } else {
            $locale = $user->getLocale();
        }
        if (null !== $locale) {
            $this->session->set('_locale', $locale);
        }
    }
}