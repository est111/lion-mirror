<?php

namespace Biocare\CallBundle\Service;

use Biocare\CallBundle\Entity\CallRegister;

/**
 * Description of CallRegister
 *
 * @author Karol Gontarski
 */
class CallService {

    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    static function register() {
        $entities = $this->em->getRepository('BiocareCallBundle:CallRegister')->findAll();
        dump($entities);
    }

}
