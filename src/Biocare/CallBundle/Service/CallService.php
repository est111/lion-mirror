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
        //$entity = $this->em->getRepository('BiocareCallBundle:CallRegister')->findById($id);
        $register = new CallRegister();
        $this->em->persist($register);
        $this->flush;
    }

}
