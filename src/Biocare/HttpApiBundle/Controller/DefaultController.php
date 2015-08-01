<?php

namespace Biocare\HttpApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/api/{test}", name="api_test")
     * @Route("/api/", name="api")
     * @Template()
     */
    public function indexAction($test = NULL)
    {
        /*$RuB2CPL = new \Biocare\HttpApiBundle\Entity\RuB2CPL($test);
        $response = $RuB2CPL->testApi();
        //$response = $RuB2CPL->getResponseHTML();
        
        dump($RuB2CPL, $response);
        */
        
        $a = new \Biocare\HttpApiBundle\Entity\HttpApi('http://is.b2cpl.ru/portal/client_api.ashx','test','test');
        dump($a);
        //$a->setUrl('http://is.b2cpl.ru/portal/client_api.ashx?client=test&key=test');
        $a->get();
        $response = $a->getResponseHTML();
        return array('name' => $response);
    }
}
