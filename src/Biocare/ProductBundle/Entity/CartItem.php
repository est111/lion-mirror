<?php

namespace Biocare\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of CartItem
 *
 * @author Karol Gontarski
 * 
 * @ORM\Table()
 * @ORM\Entity()
 */
class CartItem extends Item{
    
    
    /**
     * @ORM/Column(type="value", type="decimal", precision=15, scale=2)
     */
    private $value;
    
    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    
    
}
