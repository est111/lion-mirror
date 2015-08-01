<?php

namespace Biocare\HttpApiBundle\Entity;

use Biocare\HttpApiBundle\Entity\Curl;


class HttpApi extends Curl
{

    public function __toString() {
        return parent::__toString();
    }

    public function get($query = NULL) {
        return parent::get($query);
    }

    public function getCurl() {
        return parent::getCurl();
    }

    public function getResponse() {
        return parent::getResponse();
    }

    public function getResponseHTML() {
        return parent::getResponseHTML();
    }

    public function getUrl() {
        return parent::getUrl();
    }

    public function post() {
        parent::post();
    }

    public function setCurl($curl) {
        return parent::setCurl($curl);
    }

    public function setResponse($response) {
        return parent::setResponse($response);
    }

    public function setUrl($url) {
        return parent::setUrl($url);
    }

    public function __construct($url,$username,$password) {    
       
        $this->setUrl = $url."?client=".$username."&key=".$password;  
        parent::__construct();
    } 
    
    public function testApi(){
        parent::get();
    }

   
}
