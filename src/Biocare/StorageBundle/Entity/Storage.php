<?php

namespace Biocare\StorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Storage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\StorageBundle\Entity\StorageRepository")
 */
class Storage {

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
    public function getId() {
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
     * @ORM\OneToMany(targetEntity="\Biocare\ProductBundle\Entity\Item", mappedBy="storage")
     */
    private $item;

    /**
     * Constructor
     */
    public function __construct() {
        $this->item = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add item
     *
     * @param \Biocare\ProductBundle\Entity\Item $item
     * @return Storage
     */
    public function addItem(\Biocare\ProductBundle\Entity\Item $item) {
        $this->item[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \Biocare\ProductBundle\Entity\Item $item
     */
    public function removeItem(\Biocare\ProductBundle\Entity\Item $item) {
        $this->item->removeElement($item);
    }

    /**
     * Get item
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItem() {
        return $this->item;
    }

    public function getItemCountByProduct() {

        foreach ($this->item as $item) {
            echo $item;
        }

        return;
    }

    public function __toString() {
        return $this->getName() . " " . $this->getId();
    }

}
