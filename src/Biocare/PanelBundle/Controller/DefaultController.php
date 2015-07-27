<?php

namespace Biocare\PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Biocare\CallBundle\Entity\CallRegister;
use Biocare\CallBundle\Entity\Source;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller {

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request) {


        $session = $this->get('session');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $ip = $this->get('request')->getClientIp();

        $callregister = new CallRegister($user, $ip);

        $em = $this->getDoctrine()->getManager();
        
        
        
        $em->persist($callregister);
        $em->flush();
        
        
        $source_get = preg_replace('/\s+/', '', $request->get('source'));
        
        if($source_get){
            $source = new Source();
            $source->addCallregister($callregister);
            $em->persist($source);
        }
        
        
        

        $session->set('callregister', $callregister);


        return $this->redirectToRoute('panel');
    }

}
