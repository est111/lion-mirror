<?php

namespace Biocare\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\ProductBundle\Entity\ItemRepository")
 */

//* @ORM\InheritanceType("JOINED")
//* @ORM\DiscriminatorColumn(name="discr", type="string")

class Item
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
     * @ORM\ManyToOne(targetEntity="\Biocare\StorageBundle\Entity\Storage", inversedBy="item")
     */
    private $storage; 

    /**
     * Set storage
     *
     * @param \Biocare\StorageBundle\Entity\Storage $storage
     * @return Item
     */
    public function setStorage(\Biocare\StorageBundle\Entity\Storage $storage = null)
    {
        $this->storage = $storage;

        return $this;
    }

    /**
     * Get storage
     *
     * @return \Biocare\StorageBundle\Entity\Storage 
     */
    public function getStorage()
    {
        return $this->storage;
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="\Biocare\ProductBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     **/
    private $product; 

    /**
     * Set product
     *
     * @param \Biocare\ProductBundle\Entity\Product $product
     * @return Item
     */
    public function setProduct(\Biocare\ProductBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Biocare\ProductBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
    
    public function __toString() {
        return $this->getProduct()." ".$this->getId();
    }
    
    /**
     * @ORM\Column(name="value", type="decimal", precision=15, scale=2, nullable=true)
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
