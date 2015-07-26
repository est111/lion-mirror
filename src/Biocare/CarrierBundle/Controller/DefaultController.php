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
        $resp = $httpapi->tariff('191001');
        $resp = mb_convert_encoding($resp, "utf-8", "windows-1251");
        $response = json_decode($resp);
        return array('resp'=>  $response->delivery_ways);
    }
}
