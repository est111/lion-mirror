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
class CartItem extends Item 
{   
    /**
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;
    
    public function getWeight() {
        return $this->weight;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
        return $this;
    }

    
    /**
     * @ORM\Column(name="value", type="decimal", precision=15, scale=2)
     */
    private $value;
    
    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }
  
    /**
     * @ORM\ManyToOne(targetEntity="\Biocare\PriceBundle\Entity\Currency")
     */
    private $currency;
    
    /**
     * Set currency
     *
     * @param \Biocare\PriceBundle\Entity\Currency $currency
     * @return Price
     */
    public function setCurrency(\Biocare\PriceBundle\Entity\Currency $currency = null) {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \Biocare\CampaignBundle\Entity\Currency 
     */
    public function getCurrency() {
        return $this->currency;
    }
    
    
}
