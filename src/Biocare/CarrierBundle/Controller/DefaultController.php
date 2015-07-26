<?php

namespace Biocare\CarrierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/httpapi")
     * @Template()
     */
    public function indexAction()
    {
        $resp = new \Biocare\CarrierBundle\Entity\HttpApi();
        return array('resp'=>$resp);
    }
}
