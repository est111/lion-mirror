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
        $httpapi = new \Biocare\CarrierBundle\Entity\HttpApi();
        $resp = $httpapi->info_zip();
        dump($resp);
        return array('resp'=>  json_decode($resp));
    }
}
