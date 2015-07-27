<?php

namespace Biocare\CallBundle\Listener;

use Biocare\CallBundle\BiocareCallBundle\Entity\CallRegister;

/**
 * Description of CallRegister
 *
 * @author Karol Gontarski
 */
class CallRegister {
   
    static function register($user, $ip){
        new \Biocare\CallBundle\Entity\CallRegister($user, $ip);
    }
    
}
