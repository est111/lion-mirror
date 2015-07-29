<?php

namespace Biocare\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Biocare\CallBundle\Entity\CallRegister as CallRegister;

/**
 * Customer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\CustomerBundle\Entity\CustomerRepository")
 */
class Customer {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=128)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=128)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="fathername", type="string", length=128)
     */
    private $fathername;

    /**
     * @var string
     *
     * @ORM\Column(name="phonenumber", type="string", length=20)
     */
    private $phonenumber;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50)
     */
    private $email;

    /**
     *
     * @ORM\OneToOne(targetEntity="\Biocare\CallBundle\Entity\CallRegister")
     */
    private $callregister;

    /**
     * @ORM\ManyToMany(targetEntity="\Biocare\AddressBundle\Entity\Address")
     * @ORM\JoinTable(name="customers_addresses",
     *      joinColumns={@ORM\JoinColumn(name="customer_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="id", unique=true)}
     *      )
     * */
    private $address;

    public function getCallregister() {
        return $this->callregister;
    }

    public function setCallregister(\Biocare\CallBundle\Entity\CallRegister $callregister) {
        $this->callregister = $callregister;
        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Customer
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Customer
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set fathername
     *
     * @param string $fathername
     * @return Customer
     */
    public function setFathername($fathername) {
        $this->fathername = $fathername;

        return $this;
    }

    /**
     * Get fathername
     *
     * @return string 
     */
    public function getFathername() {
        return $this->fathername;
    }

    /**
     * Set phonenumber
     *
     * @param string $phonenumber
     * @return Customer
     */
    public function setPhonenumber($phonenumber) {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    /**
     * Get phonenumber
     *
     * @return string 
     */
    public function getPhonenumber() {
        return $this->phonenumber;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->address = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Customer
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Add address
     *
     * @param \Biocare\AddressBundle\Entity\Address $address
     * @return Customer
     */
    public function addAddress(\Biocare\AddressBundle\Entity\Address $address) {
        $this->address[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \Biocare\AddressBundle\Entity\Address $address
     */
    public function removeAddress(\Biocare\AddressBundle\Entity\Address $address) {
        $this->address->removeElement($address);
    }

    /**
     * Get address
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddress() {
        return $this->address;
    }

    public function __toString() {
        return $this->getFirstname() . ' ' . $this->getLastname();
    }

}
