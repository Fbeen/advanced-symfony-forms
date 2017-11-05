<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\ProductOption;

/**
 * CartOptions
 *
 * @ORM\Table(name="cart_options")
 * @ORM\Entity
 */
class CartOption
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
     * @ORM\ManyToOne(targetEntity="CartItem", inversedBy="options")
     * @ORM\JoinColumn(name="cartitem_id", referencedColumnName="id")
     */
    private $cartItem;
    
    /**
     * @ORM\ManyToOne(targetEntity="ProductOption")
     * @ORM\JoinColumn(name="option_id", referencedColumnName="id")
     */
    private $productOption;
    
    /**
     * @ORM\ManyToOne(targetEntity="ProductOptionChoice")
     * @ORM\JoinColumn(name="choice_id", referencedColumnName="id")
     */
    private $productOptionChoice;

    
    public function __construct(ProductOption $productOption)
    {
        $this->productOption = $productOption;
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
     * Set cartItem
     *
     * @param \AppBundle\Entity\CartItem $cartItem
     *
     * @return CartOption
     */
    public function setCartItem(\AppBundle\Entity\CartItem $cartItem = null)
    {
        $this->cartItem = $cartItem;

        return $this;
    }

    /**
     * Get cartItem
     *
     * @return \AppBundle\Entity\CartItem
     */
    public function getCartItem()
    {
        return $this->cartItem;
    }

    /**
     * Set productOption
     *
     * @param \AppBundle\Entity\ProductOption $productOption
     *
     * @return CartOption
     */
    public function setProductOption(\AppBundle\Entity\ProductOption $productOption = null)
    {
        $this->productOption = $productOption;

        return $this;
    }

    /**
     * Get productOption
     *
     * @return \AppBundle\Entity\ProductOption
     */
    public function getProductOption()
    {
        return $this->productOption;
    }

    /**
     * Set productOptionChoice
     *
     * @param \AppBundle\Entity\ProductOptionChoice $productOptionChoice
     *
     * @return CartOption
     */
    public function setProductOptionChoice(\AppBundle\Entity\ProductOptionChoice $productOptionChoice = null)
    {
        $this->productOptionChoice = $productOptionChoice;

        return $this;
    }

    /**
     * Get productOptionChoice
     *
     * @return \AppBundle\Entity\ProductOptionChoice
     */
    public function getProductOptionChoice()
    {
        return $this->productOptionChoice;
    }
}
