<?php

namespace Biocare\CallBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Source
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\CallBundle\Entity\SourceRepository")
 */
class Source
{
    
    public function __construct() {
        $this->callregister = new \Doctrine\Common\Collections\ArrayCollection();
    }
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
     * @ManyToMany(targetEntity="CallRegister")
     * @JoinTable(name="source_callregister",
     *      joinColumns={@JoinColumn(name="source_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="callregister_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $callregister;
    

}