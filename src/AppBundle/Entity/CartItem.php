<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\CartOption;

/**
 * CartItem
 *
 * @ORM\Table(name="cart_items")
 * @ORM\Entity
 */
class CartItem
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
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount = 1;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @ORM\OneToMany(targetEntity="CartOption", mappedBy="cartItem", cascade={"persist", "remove"}))
     */
    private $options;


    public function __construct(\AppBundle\Entity\Product $product)
    {
        $this->options = new ArrayCollection();
        $this->product = $product;
        
        /*
         * Voeg net zoveel CartOption enitities toe aan de $options collection
         * als het aantal ProductOptions dat $product heeft.
         */
        foreach ($product->getOptions() as $option) {
            $this->addOption(new CartOption($option));
        }
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
     * Set amount
     *
     * @param integer $amount
     *
     * @return CartItem
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return CartItem
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Add option
     *
     * @param \AppBundle\Entity\CartOption $option
     *
     * @return CartItem
     */
    public function addOption(\AppBundle\Entity\CartOption $option)
    {
        $this->options[] = $option;
        $option->setCartItem($this);

        return $this;
    }

    /**
     * Remove option
     *
     * @param \AppBundle\Entity\CartOption $option
     */
    public function removeOption(\AppBundle\Entity\CartOption $option)
    {
        $this->options->removeElement($option);
    }

    /**
     * Get options
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOptions()
    {
        return $this->options;
    }
}
