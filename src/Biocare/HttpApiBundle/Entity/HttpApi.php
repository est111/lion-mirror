<?php

namespace Biocare\HttpApiBundle\Entity;

use Biocare\HttpApiBundle\Entity\Curl;


class HttpApi extends Curl
{

    public function __construct($url,$username,$password) {    
        $this->setUrl = $url."?client=".$username."&key=".$password;  
        parent::__construct();
    } 
}
