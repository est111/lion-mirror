<?php

namespace Biocare\CarrierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/httpapi/{zip}")
     */
    public function indexAction($zip)
    {
        $httpapi = new \Biocare\CarrierBundle\Entity\HttpApi();
        $resp_raw = $httpapi->tariff($zip);
        $resp_conv = mb_convert_encoding($resp_raw, "utf-8", "windows-1251");
        $resp = json_decode($resp_conv);
        $html ="<select>";
        foreach ($resp->delivery_ways as $dw){ 
            $html .="<option value='".$dw->Стоимость."'>".$dw->Наименование." - ".$dw->Стоимость." - ".$dw->Код."</option>";
        }
        $html .="</select>";


	return new Response($html, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'text/html'));

    }
}
