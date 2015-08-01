<?php

namespace Biocare\HttpApiBundle\Entity;

class RuB2CPL extends HttpApi {

    public function __construct($test = NULL) {

        $url = "http://is.b2cpl.ru/portal/client_api.ashx?";

        if ($test) {
            $username = "test";
            $password = "test";
        } else {
            $username = "OOOMIKSPRAYS";
            $password = "9A7A4EAC";
        }
        parent::__construct($url, $username, $password);
    }

    public function getResponse() {
        $response = mb_convert_encoding(parent::getResponse(), "UTF-8", "Windows-1251");
        return $response;
    }

    
    public function getResponseTEST() {
        $response_array = json_decode($this->getResponse(), true);
        $response_md5 = md5($this->getResponse());
        $response = '# ['.$response_md5 ."] ". count($response_array['delivery_ways'])." "."</br>";
                foreach ($response_array['delivery_ways'] as $dw ){
                    $response .= implode("<br/>, ", $dw);
                }
        
        return $response;
        
    }


    public function tarif($zip,$weight,$dimensions,$type,$price) {
        $this->getQuery('&func=tarif&zip='.$zip.'&weight='.$weight.'&x='.$dimensions[0].'&y='.$dimensions[0].'&z='.$dimensions[0].'&type='.$type.'&price='.$price.'');
    }

}
