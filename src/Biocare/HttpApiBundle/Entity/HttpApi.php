<?php

namespace Biocare\HttpApiBundle\Entity;

use Biocare\HttpApiBundle\Entity\Curl;


class HttpApi extends Curl
{
   
    public function __construct($url,$username,$password) {     
        $this->setUrl = $url."?client=".$username."&key=".$password;  
        parent::__construct();
    } 
    
    public function testApi(){
       $this->get();
   }

    public function __toString() {
       $return = "<pre>";
       $return .= $this->getResponse();
       $return .= "</pre>";
       
       return $return;       
   }
   
}
