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
     * @ORM\ManyToMany(targetEntity="CallRegister")
     * @ORM\JoinTable(name="source_callregister",
     *      joinColumns={@ORM\JoinColumn(name="source_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="callregister_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $callregister;
    


    /**
     * Add callregister
     *
     * @param \Biocare\CallBundle\Entity\CallRegister $callregister
     * @return Source
     */
    public function addCallregister(\Biocare\CallBundle\Entity\CallRegister $callregister)
    {
        $this->callregister[] = $callregister;

        return $this;
    }

    /**
     * Remove callregister
     *
     * @param \Biocare\CallBundle\Entity\CallRegister $callregister
     */
    public function removeCallregister(\Biocare\CallBundle\Entity\CallRegister $callregister)
    {
        $this->callregister->removeElement($callregister);
    }

    /**
     * Get callregister
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCallregister()
    {
        return $this->callregister;
    }
}
