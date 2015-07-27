<?php

namespace Biocare\PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Biocare\CallBundle\Entity\CallRegister;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        $callregister = new CallRegister($user,$ip);
        $name = $callregister->getCreatedBy();      
        return array('name' => $name);
    }
}
