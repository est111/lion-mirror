<?php

namespace Biocare\PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Biocare\CallBundle\Entity\CallRegister;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        $ip = $this->get('request')->getClientIp();
    
        $session = $this->get('session');
        if(!isset($session->get('callregister')))
        {   
        $callregister = new CallRegister($user,$ip);
        $em = $this->getDoctrine()->getManager();
        $em->persist($callregister);
        $em->flush();
        
        $session = $this->get('session');
        $session->set('callregister', $callregister->getId());
    }
        
        $name = $callregister->getCreatedBy();   
        
        dump($callregister);
        
        return array('name' => $name);
    }
}
