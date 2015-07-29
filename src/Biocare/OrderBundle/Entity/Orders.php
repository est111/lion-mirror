<?php

namespace Biocare\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\OrderBundle\Entity\OrdersRepository")
 */
class Orders
{
    public function __construct() {
        
        $this->setCreatedAt(new \DateTime('NOW', new \DateTimeZone('UTC')));
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
     *
     * @ORM\OneToOne(targetEntity="\Biocare\CallBundle\Entity\CallRegister")
     */
    private $callregister;
    
    public function getCallregister() {
        return $this->callregister;
    }

    public function setCallregister(\Biocare\CallBundle\Entity\CallRegister $callregister) {
        $this->callregister = $callregister;
        return $this;
    }


}
