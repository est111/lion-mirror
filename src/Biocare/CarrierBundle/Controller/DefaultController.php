<?php

namespace Biocare\CarrierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/httpapi/{zip}")
     * @Template()
     */
    public function indexAction($zip)
    {
        $httpapi = new \Biocare\CarrierBundle\Entity\HttpApi();
        $resp = $httpapi->tariff('191001');
        $resp = mb_convert_encoding($resp, "utf-8", "windows-1251");
        $response = json_decode($resp);
        $response ="<select>";
        foreach ($response->delivery_ways as $dw){
        $response +="<option value='".$dw['Стоимость']."'>".$dw['Наименование']." - ".$dw['Стоимость']." - ".$dw['Код']."</option>";
        }
        $response +="</select>";
        return array('resp'=>  $response->delivery_ways);
    }
}
