<?php

namespace Biocare\PriceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Currency
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\PriceBundle\Entity\CurrencyRepository")
 */
class Currency
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @ORM\Column(name="code", type="string", length=3)
     */
    private $code;
    
    public function getCode() {
        return $this->code;
    }

    public function setCode($code) {
        $this->code = $code;
        return $this;
    }
    
    /**
     * @ORM\Column(name="symbol", type="string", length=1)
     */
    private $symbol;
    
    public function getSymbol() {
        return $this->symbol;
    }

    public function setSymbol($symbol) {
        $this->symbol = $symbol;
        return $this;
    }
    
    public function __toString() {
        return $this->getCode();
    }
    
}
