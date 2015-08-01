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
        $RuB2CPL = new \Biocare\HttpApiBundle\Entity\RuB2CPL($test);
        $RuB2CPL->testApi();
        $response = $RuB2CPL->getResponseHTML();
        
        return array('name' => $response);
    }
}
