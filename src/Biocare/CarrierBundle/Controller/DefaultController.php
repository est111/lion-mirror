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
        $resp = $httpapi->tariff('191001');
        $resp = mb_convert_encoding($resp, "utf-8", "windows-1251");
        $resp = json_decode($resp);
        $html ="<select>";
        foreach ($resp->delivery_ways as $dw){
        $html +="<option value='".$dw->Стоимость."'>".$dw->Наименование." - ".$dw->Стоимость." - ".$dw->Код."</option>";
        }
        $html +="</select>";
        $response = new Response();
        $response->setContent($html);
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/html');

        // prints the HTTP headers followed by the content
        $response->send();
    }
}
