<?php

namespace Biocare\HttpApiBundle\Entity;

/**
 * Description of Curl
 *
 * @author Karol Gontarski
 */
class Curl {

    private $curl;
    private $url;
    private $response;

    public function getResponse() {
        return $this->response;
    }

    public function setResponse($response) {
        $this->response = $response;
        return $this;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    public function getCurl() {
        return $this->curl;
    }

    public function setCurl($curl) {
        $this->curl = $curl;
        return $this;
    }

    public function __construct() {
        $this->setCurl(curl_init());
    }

    public function post() {
        
    }

    public function get($query = NULL) {
        curl_setopt_array($this->getCurl(), array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->getUrl().$query,
            CURLOPT_USERAGENT => 'Karol Gontarski cURL Agent',
        ));
        
        $this->setResponse(curl_exec($this->getCurl()));
        return $this;
    }


}
