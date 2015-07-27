<?php

namespace Biocare\CallBundle\Listener;

use Biocare\CallBundle\Entity\CallRegister;

/**
 * Description of CallRegister
 *
 * @author Karol Gontarski
 */
class CallRegister {
   
    static function register($user, $ip){
        new CallRegister($user, $ip);
    }
    
}
