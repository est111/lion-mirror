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
    
    
    
    public function __construct( $source, $destination) {
        
        
        $createdAt =  new \DateTime('NOW', \DateTimeZone::UTC );
        
        $this->setCreatedAt($createdAt);
        $this->setSource($source);
        $this->setDestination($destination);
        
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

    /**
     * @var String $source Source of connextion
     * 
     * @ORM\Column(name="source", type="string", length=255)
     * 
     */
    private $source;

    public function getSource() {
        return $this->source;
    }

    public function setSource( $source) {
        $this->source = $source;
        return $this;
    }

    
    /**
     * @var String Destination of connextion 
     * 
     * @ORM\Column(name="destination", type="string", length=255)
     * 
     */
    private $destination;
 
    public function getDestination() {
        return $this->destination;
    }

    public function setDestination($destination) {
        $this->destination = $destination;
        return $this;
    }


    
}
