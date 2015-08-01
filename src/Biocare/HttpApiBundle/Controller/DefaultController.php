<?php

namespace Biocare\HttpApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/api/{test}")
     * @Template()
     */
    public function indexAction($test = NULL)
    {
        $RuB2CPL = new \Biocare\HttpApiBundle\Entity\RuB2CPL($test);
        
        dump($RuB2CPL);
        exit();
        
        return array('name' => $name);
    }
}
