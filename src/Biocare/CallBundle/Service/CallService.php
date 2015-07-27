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

    public function register() {
        if (isset($this->id)){
            $entity = $this->em->getRepository('BiocareCallBundle:CallRegister')->findById($this->id);
        }
        $register = new CallRegister();
        $this->em->persist($register);
        $this->flush;
    }

}
