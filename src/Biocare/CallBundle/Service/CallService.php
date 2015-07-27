<?php

namespace Biocare\CallBundle\Service;

use Doctrine\ORM\EntityManager;
use Biocare\CallBundle\Entity\CallRegister;
use Symfony\Component\Security\Core\Util\SecureRandom;

/**
 * Description of CallRegister
 *
 * @author Karol Gontarski
 */
class CallService {

    private $id;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function __construct() {

        $generator = new SecureRandom();
        $this->setId($generator->nextBytes(10));
        
        
    }

}
