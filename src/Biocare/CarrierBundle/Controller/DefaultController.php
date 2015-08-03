<?php

namespace Biocare\CarrierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    /**
     * @Route("/httpapi/{zip}/{price}/{weight}",name="httpapi_zip")
     */
    public function indexAction($zip,$price,$weight) {
        $httpapi = new \Biocare\CarrierBundle\Entity\HttpApi();
        $resp_raw = $httpapi->tariff($zip,$price,$weight);
        $resp_conv = mb_convert_encoding($resp_raw, "utf-8", "windows-1251");
        $resp = json_decode($resp_conv);
        $html = "<select class='col-lg-12 select2'>";
        foreach ($resp->delivery_ways as $dw) {
            $html .="<option value='" . $dw->Стоимость . "'>" . $dw->Наименование . " - " . $dw->Стоимость . " - " . $dw->Код . "</option>";
        }
        $html .="</select>";


        return new Response($html, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'text/html'));
    }

    /**
     * @Route("/aaa",name="aaa")
     */
    public function aAction() {
    }

}
