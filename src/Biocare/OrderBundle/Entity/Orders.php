<?php

namespace Biocare\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\OrderBundle\Entity\OrdersRepository")
 */
class Orders {

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
    public function getId() {
        return $this->id;
    }

    /**
     * @var \DateTime DataTime when Connextion were created Datatime with UTC  
     * 
     * @ORM\Column(name="savedAt", type="datetimetz", nullable=true)
     * 
     */
    private $savedAt;

    public function getSavedAt() {
        return $this->savedAt;
    }

    public function setSavedAt(\DateTime $savedAt) {
        $this->savedAt = $savedAt;
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

    /**
     *
     * @ORM\OneToOne(targetEntity="\Biocare\CustomerBundle\Entity\Customer")
     */
    private $customer;

    public function getCustomer() {
        return $this->customer;
    }

    public function setCustomer($customer) {
        $this->customer = $customer;
        return $this;
    }

    /**
     *
     * @ORM\OneToOne(targetEntity="\Biocare\AddressBundle\Entity\Address")
     */
    private $address;

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    /**
     *
     * @ORM\OneToOne(targetEntity="\Biocare\StorageBundle\Entity\Cart")
     */
    private $cart;
    
    public function getCart() {
        return $this->cart;
    }

    public function setCart($cart) {
        $this->cart = $cart;
        return $this;
    }


    
    
}
