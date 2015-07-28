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
class Customer
{
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
     *
     * @ORM\OneToOne(targetEntity="Biocare\CallBundle\Entity\CallRegister")
     */
    private $callregister;

    public function getCallregister() {
        return $this->callregister;
    }

    public function setCallregister($callregister) {
        $this->callregister = $callregister;
        return $this;
    }

        
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
     * Set firstname
     *
     * @param string $firstname
     * @return Customer
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Customer
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set fathername
     *
     * @param string $fathername
     * @return Customer
     */
    public function setFathername($fathername)
    {
        $this->fathername = $fathername;

        return $this;
    }

    /**
     * Get fathername
     *
     * @return string 
     */
    public function getFathername()
    {
        return $this->fathername;
    }

    /**
     * Set phonenumber
     *
     * @param string $phonenumber
     * @return Customer
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    /**
     * Get phonenumber
     *
     * @return string 
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }
}
