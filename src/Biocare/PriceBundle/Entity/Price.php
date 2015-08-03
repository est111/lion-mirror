<?php

namespace Biocare\PriceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Price
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biocare\PriceBundle\Entity\PriceRepository")
 */
class Price
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
     * @var \DateTime
     *
     * @ORM\Column(name="startAt", type="datetimetz")
     */
    private $startAt;

    /**
     * @var 
     *
     * @ORM\ManyToOne(targetEntity="Currency")
     */
    private $currency;


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
     * Set startAt
     *
     * @param \DateTime $startAt
     * @return Price
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * Get startAt
     *
     * @return \DateTime 
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Set currency
     *
     * @param \stdClass $currency
     * @return Price
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \stdClass 
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
