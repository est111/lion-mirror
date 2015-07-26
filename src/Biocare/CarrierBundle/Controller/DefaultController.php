<?php

namespace Biocare\CarrierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/httpapi")
     * @Template()
     */
    public function indexAction()
    {
        $httpapi = new \Biocare\CarrierBundle\Entity\HttpApi();
        $resp = $httpapi->info_zip();
        
        $response = new Response();
        $response->setContent($resp);
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/html');
        $response->setCharset('UTF-8');
        // prints the HTTP headers followed by the content
        $response->send();
        return array('resp'=>  $response->send());
    }
}
