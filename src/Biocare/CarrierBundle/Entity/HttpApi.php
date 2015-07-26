<?php

namespace Biocare\CarrierBundle\Entity;


/**
 * HttpApi
 *
 */
class HttpApi
{

    private $url;
    
    
    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

        
    public function __construct() {
        $url = "";
        
        
        $this->setUrl($url);
    }
    
    
    
}
