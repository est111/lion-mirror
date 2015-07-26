<?php

namespace Biocare\CarrierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HttpApi
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\CarrierBundle\Entity\HttpApiRepository")
 */
class HttpApi
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
