<?php

namespace Biocare\PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Biocare\CallBundle\Entity\CallRegister;

class DefaultController extends Controller {

    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name) {


        $session = $this->get('session');
        $callregister = $session->get('callregister');
        
        if (!$callregister) {
            
            $user = $this->get('security.token_storage')->getToken()->getUser();
            
            $ip = $this->get('request')->getClientIp();
            
            $callregister = new CallRegister($user, $ip);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($callregister);
            $em->flush();

            $session->set('callregister',$callregister);
        } 

        return array('callregister' => $callregister);
    }

}
