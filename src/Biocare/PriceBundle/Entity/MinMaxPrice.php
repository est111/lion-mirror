<?php

namespace Biocare\PriceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Price
 *
 * @ORM\Entity()
 * @ORM\Table()
 * 
 */
class MinMaxPrice extends Price
{
    public function __construct() {
        $this->setType('minmax');        
    }
    
    private $max;
    
    public function getMax() {
        return $this->max;
    }

    public function setMax($max) {
        $this->max = $max;
        return $this;
    }
   
    private $min;
    
    public function getMin() {
        return $this->min;
    }

    public function setMin($min) {
        $this->min = $min;
        return $this;
    }
   
    
}
