<?php

namespace Biocare\CallBundle\Listener;

use Biocare\CallBundle\Entity\CallRegister;

/**
 * Description of CallRegister
 *
 * @author Karol Gontarski
 */
class CallListener {
   
    static function register(){
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('BiocareCallBundle:CallRegister')->findAll();
        dump($entities);
    }
    
}
