<?php

namespace Biocare\ConnectionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template; 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     * @Route("/")
     * @Method({"GET"})
     * 
     * @Template() 
     */
    public function indexAction(Request $request)
    {
        
        $source      = preg_replace('/\s+/', '', $request->get('source'));
        $destination = preg_replace('/\s+/', '', $request->get('destination'));
        
        dump($source,$destination);
        exit;
        return array('name' => $name);
    }
}
