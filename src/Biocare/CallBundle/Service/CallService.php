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

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function __construct(EntityManager $entityManager, $user, $ip) {
        $this->em = $entityManager;
        if (isset($this->id)) {
            $register = $this->em->getRepository('BiocareCallBundle:CallRegister')->findById($this->id);
        } else {
            $register = new CallRegister($user, $ip);
            $this->em->persist($register);
            $this->em->flush();
            $this->setId($register->getId());
        }

        return $register;
    }

}
