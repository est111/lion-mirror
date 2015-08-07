<?php
namespace Yellowknife\SecurityBundle\Authentication\Handler;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Routing\Router;

class LogoutSuccessHandler implements LogoutSuccessHandlerInterface {

  private $security;  
  private $router;  

    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

  public function onLogoutSuccess(Request $request) {
     $user = $this->security->getToken()->getUser();

     //add code to handle $user here
     //...

     $response =  RedirectResponse($this->router->generate('login'));

    return $response;
  }
}