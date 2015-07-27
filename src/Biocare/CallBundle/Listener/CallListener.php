<?php

namespace Biocare\CallBundle\Listener;

use Biocare\CallBundle\Entity\CallRegister;

/**
 * Description of CallRegister
 *
 * @author Karol Gontarski
 */
class CallListener {
   
    static function register($user, $ip){
        new CallRegister($user, $ip);
    }
    
}