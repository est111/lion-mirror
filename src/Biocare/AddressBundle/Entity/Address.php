<?php

namespace Biocare\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\AddressBundle\Entity\AddressRepository")
 */
class Address
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * var $country String
     * 
     * @ORM\Column(name="country", type="string",length=100)
     */
    
    private $country;
    
    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }


}
