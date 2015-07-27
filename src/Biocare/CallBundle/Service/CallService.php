<?php

namespace Biocare\CallBundle\Service;

use Doctrine\ORM\EntityManager;
use Biocare\CallBundle\Entity\CallRegister;

/**
 * Description of CallRegister
 *
 * @author Karol Gontarski
 */
class CallService {

    private $id;
    
    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    public function register($user,$ip) {
        if (isset($this->id)){
            $register = $this->em->getRepository('BiocareCallBundle:CallRegister')->findById($this->id);
        } else  {            
            $register = new CallRegister($user,$ip);
        }
        $this->em->persist($register);
        $this->em->flush();
    }

}
