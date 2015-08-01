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
        $response = '# ['.$response_md5 ."] ". $response_array['delivery_ways'][0]["Стоимость"]."</br>";
        
        return $response;
        
    }


    public function tarif() {
        $this->getQuery('&func=tarif&zip=125032&weight=1001&x=121&y=1&z=1&type=post_add&price=10000');
    }

}
