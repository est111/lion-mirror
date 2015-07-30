<?php

namespace Biocare\StorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Storage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\StorageBundle\Entity\StorageRepository")
 */
class Storage
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
     * @ORM\OneToMany(targetEntity="\Biocare\ProductBundle\Entity\Item", inversedBy="storage")
     */
    private $item;
    
}
