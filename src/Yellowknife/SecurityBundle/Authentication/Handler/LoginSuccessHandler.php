<?php
namespace Yellowknife\SecurityBundle\Authentication\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Doctrine\ORM\EntityManager;
 
class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected 
        $router,
        $security,
        $em;
    
    public function __construct(Router $router, SecurityContext $security,EntityManager $em)
    {
        $this->router = $router;
        $this->security = $security;
        $this->em = $em;
    }
    
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $userlog = new \Yellowknife\SecurityBundle\Entity\UserLog($this->security->getToken()->getUser());
        $em->persist($userlog);
        $em->flush();
        
        
        // URL for redirect the user to where they were before the login process begun if you want.
        // $referer_url = $request->headers->get('referer');
        
        // Default target for unknown roles. Everyone else go there.
        $url = 'panel';
        
        if($this->security->isGranted('ROLE_ADMIN')) {
            $url = 'admin';
        }
        
        if($this->security->isGranted('ROLE_USER')) {
            $url = 'panel';
        }     
        
        $response = new RedirectResponse($this->router->generate($url));
            
        return $response;
    }
}