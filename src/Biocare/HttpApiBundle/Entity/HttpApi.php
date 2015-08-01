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
        parent::get('&func=tarif&zip=125032&weight=1001&x=121&y=1&z=1&type=post_add&price=10000');
    }

   
}
