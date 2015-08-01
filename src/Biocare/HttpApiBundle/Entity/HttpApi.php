<?php

namespace Biocare\HttpApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class HttpApi
{
   
    public function __construct($url,$username,$password) {     
        $this->setUrl = $url."?client=".$username."&key=".$password;        
    } 
    
   private $url;
   
   private $response; 
   
   public function getUrl() {
       return $this->url;
   }

   public function setUrl($url) {
       $this->url = $url;
       return $this;
   }

   public function getResponse() {
       return $this->response;
   }

   public function setResponse($response) {
       $this->response = $response;
       return $this;
   }

   
}
