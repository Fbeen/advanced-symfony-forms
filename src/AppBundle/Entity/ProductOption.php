<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ProductOption
 *
 * @ORM\Table(name="product_options")
 * @ORM\Entity
 */
class ProductOption
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
     * @ORM\Column(name="optionLabel", type="string", length=64, nullable=true)
     */
    private $optionLabel;

    /**
     * @ORM\OneToMany(targetEntity="ProductOptionChoice", mappedBy="option", cascade={"persist", "remove"})
     */
    private $choices;

    
    public function __construct()
    {
        $this->choices = new ArrayCollection();
    }
    
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
     * @return ProductOption
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
     * Set optionLabel
     *
     * @param string $optionLabel
     *
     * @return ProductOption
     */
    public function setOptionLabel($optionLabel)
    {
        $this->optionLabel = $optionLabel;

        return $this;
    }

    /**
     * Get optionLabel
     *
     * @return string
     */
    public function getOptionLabel()
    {
        return $this->optionLabel;
    }

    /**
     * Add choice
     *
     * @param \AppBundle\Entity\ProductOptionChoice $choice
     *
     * @return ProductOption
     */
    public function addChoice(\AppBundle\Entity\ProductOptionChoice $choice)
    {
        $this->choices[] = $choice;
        $choice->setOption($this);
        
        return $this;
    }

    /**
     * Remove choice
     *
     * @param \AppBundle\Entity\ProductOptionChoice $choice
     */
    public function removeChoice(\AppBundle\Entity\ProductOptionChoice $choice)
    {
        $this->choices->removeElement($choice);
    }

    /**
     * Get choices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChoices()
    {
        return $this->choices;
    }
}
