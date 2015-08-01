<?php

namespace Biocare\HttpApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RuB2CPL
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\HttpApiBundle\Entity\RuB2CPLRepository")
 */
class RuB2CPL
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
}
