<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductOptionChoice
 *
 * @ORM\Table(name="product_option_choices")
 * @ORM\Entity
 */
class ProductOptionChoice
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price = .0;
    
    /**
     * @ORM\ManyToOne(targetEntity="ProductOption", inversedBy="choices")
     * @ORM\JoinColumn(name="option_id", referencedColumnName="id")
     */
    private $option;

    
    public function __toString()
    {
        return $this->name;
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return ProductOptionChoice
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return ProductOptionChoice
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set option
     *
     * @param \AppBundle\Entity\ProductOption $option
     *
     * @return ProductOptionChoice
     */
    public function setOption(\AppBundle\Entity\ProductOption $option = null)
    {
        $this->option = $option;

        return $this;
    }

    /**
     * Get option
     *
     * @return \AppBundle\Entity\ProductOption
     */
    public function getOption()
    {
        return $this->option;
    }
}
