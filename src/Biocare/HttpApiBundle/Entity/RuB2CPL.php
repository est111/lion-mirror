<?php

namespace Biocare\HttpApiBundle\Entity;


class RuB2CPL extends HttpApi {

    public function __construct($test = NULL) {
        
        $url = "http://is.b2cpl.ru/portal/client_api.ashx";

        if ($test) {
            $username = "test";
            $password = "test";
        } else {
            $username = "OOOMIKSPRAYS";
            $password = "9A7A4EAC";            
        }
        parent::__construct($url, $username, $password);
    }


    public function Tarif() {
        
    }

}
