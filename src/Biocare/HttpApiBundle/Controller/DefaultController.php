<?php

namespace Biocare\HttpApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Route("/api/", name="api")
     * @Template()
     */
    public function indexAction() {

        $a = new \Biocare\HttpApiBundle\Entity\RuB2CPL('test');    
        $a->tarif();
        $response = $a->getResponseHTML();

        $b = new \Biocare\HttpApiBundle\Entity\RuB2CPL();   
        $b->tarif();
        $response .= $b->getResponseHTML();
        
        
        
        return array('name' => $response);
    }

}
