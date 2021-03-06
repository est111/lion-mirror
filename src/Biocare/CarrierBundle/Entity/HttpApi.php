<?php

namespace Biocare\CarrierBundle\Entity;

/**
 * HttpApi
 *
 */
class HttpApi {

    private $url;

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    public function __construct() {
        $url = "http://is.b2cpl.ru/portal/client_api.ashx?client=OOOMIKSPRAYS&key=9A7A4EAC";

        $this->setUrl($url);
    }

    public function info_zip($zip) {
        $curl = curl_init();
// Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->url."&func=info_zip&zip=".$zip,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request',
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        return $resp;
    }
    
        public function tariff($zip,$price='1000',$weight="1000") {
        $curl = curl_init();
// Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->url."&func=tarif&zip=".$zip."&weight=".$weight."&x=1&y=1&z=1&type=post_add&price=".$price."",
            CURLOPT_USERAGENT => 'Codular Sample cURL Request',
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        return $resp;
    }
    

}
