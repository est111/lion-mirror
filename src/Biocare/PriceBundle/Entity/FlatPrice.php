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
class FlatPrice extends Price
{
    public function __construct() {
        $this->setType('flat');        
    }
    
    private $value;
    
    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }
}
