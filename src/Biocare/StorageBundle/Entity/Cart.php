<?php

namespace Biocare\StorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Description of Cart
 *
 * @author Karol Gontarski
 * @ORM\Table()
 * @ORM\Entity()
 * 
 */

class Cart extends Storage{

    
    public function __construct() {
        $createdAt =  new \DateTime('NOW', new \DateTimeZone('UTC') );
        $this->setCreatedAt($createdAt);
        parent::__construct();
    }

    /**
     * @var \DateTime DataTime when Connextion were created Datatime with UTC  
     * 
     * @ORM\Column(name="createdAt", type="datetimetz")
     * 
     */
    private $createdAt;
    
    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;
        return $this;
    }
    
}
