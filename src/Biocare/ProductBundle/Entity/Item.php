<?php

namespace Biocare\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\ProductBundle\Entity\ItemRepository")
 */
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
}
