<?php

namespace Biocare\ConnectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Connexion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\ConnectionBundle\Entity\ConnexionRepository")
 */
class Connexion
{
    
    public function __construct() {
        
        $createdAt =  new \DateTime('NOW', \DateTimeZone::UTC );
        $this->setCreatedAt($createdAt);
        
        return $this;
    }
    
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @var \DateTime DataTime of Connextion [DATETIME WITH TIME ZONE]
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
