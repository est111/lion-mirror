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
     * @Route("/", name="call")
     * @Template()
     */
    public function indexAction(Request $request) {


        $session = $this->get('session');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $ip = $this->get('request')->getClientIp();

       // if(!$info){
       //     $info = preg_replace('/\s+/', '', $request->get('info'));
        //}
        // ZOPIER PL
        
        $info = explode('-', $info);
        
        $source         = $info[0] ? $info[0] : null;
        $destination    = $info[1] ? $info[1] : null;

        $callregister = new CallRegister();
        $callregister->setCreatedBy($user);
        $callregister->setCreatedFromIp($ip);

        $em = $this->getDoctrine()->getManager();
        $em->persist($callregister);
        $em->flush();


        $session->set('callregister', $callregister);


        return $this->redirectToRoute('panel');
    }

}
