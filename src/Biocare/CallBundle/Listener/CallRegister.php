<?php

namespace Biocare\CallBundle\Listener;

use Biocare\CallBundle\Entity\CallRegister;

/**
 * Description of CallRegister
 *
 * @author Karol Gontarski
 */
class CallListner {
   
    static function register($user, $ip){
        new CallRegister($user, $ip);
    }
    
}
