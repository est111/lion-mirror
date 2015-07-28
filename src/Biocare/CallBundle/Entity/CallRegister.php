<?php

namespace Biocare\CallBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CallRegister
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\CallBundle\Entity\CallRegisterRepository")
 */
class CallRegister
{
    public function __construct() {
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
     * @var string $createdFromIp
     *
     * @Gedmo\IpTraceable(on="create")
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $createdFromIp;
    
    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetimetz")
     */
    private $created;
    
    /**
     * @var string $createdBy
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(type="string")
     */
    private $createdBy;
    
    /**
     * @var string $source
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $source;

    /**
     * @var string $destination
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $destination;    
    
    /**
     * Set createdFromIp
     *
     * @param string $createdFromIp
     * @return CallRegister
     */
    public function setCreatedFromIp($createdFromIp)
    {
        $this->createdFromIp = $createdFromIp;
        return $this;
    }

    /**
     * Get createdFromIp
     *
     * @return string 
     */
    public function getCreatedFromIp()
    {
        return $this->createdFromIp;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return CallRegister
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this; 
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return CallRegister
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy->getUsername();
        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
    
    public function getSource() {
        return $this->source;
    }

    public function getDestination() {
        return $this->destination;
    }

    public function setSource($source) {
        $this->source = $source;
        return $this;
    }

    public function setDestination($destination) {
        $this->destination = $destination;
        return $this;
    }

    public function __toString() {
        return $this->getCreatedBy().' '.$this->getId();
    }
    
}
