<?php

namespace Biocare\StorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Description of Cart
 *
 * @author Karol Gontarski
 * @ORM\Table()
 */
class Cart extends Storage{


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
     *
     * @var type 
     */    
    private $createAt;
    
}
