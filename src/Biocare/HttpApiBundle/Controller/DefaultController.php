<?php

namespace Biocare\HttpApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Route("/api/{test}", name="api_test")
     * @Route("/api/", name="api")
     * @Template()
     */
    public function indexAction($test = NULL) {

        $a = new \Biocare\HttpApiBundle\Entity\RuB2CPL('test');
        
        $a->testApi();
        dump($a);
        $response = $a->getResponseHTML();
        return array('name' => $response);
    }

}
