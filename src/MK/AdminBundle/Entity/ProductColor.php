<?php

namespace MK\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use MK\CommonBundle\Utilities\Utilities;

/**
 * @ORM\Table(name="mk_product_color")
 * @ORM\Entity(repositoryClass="MK\AdminBundle\Repository\ProductColorRepository")
 */
class ProductColor
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(name="string", type="string")
     */
    private $name;
    
    /**
     * @ORM\Column(name="color", type="string")
     */
    private $color;
    
     /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="productColor")
     **/
    private $product;

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
     * 
     * @return String
     */
    public function __toString()
    {
        return (String) $this->name;
    }
    /**
     * Set name
     *
     * @param string $name
     * @return ProductColor
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
     * Set color
     *
     * @param string $color
     * @return ProductColor
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add product
     *
     * @param \MK\AdminBundle\Entity\Product $product
     * @return ProductColor
     */
    public function addProduct(\MK\AdminBundle\Entity\Product $product)
    {
        $this->product[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \MK\AdminBundle\Entity\Product $product
     */
    public function removeProduct(\MK\AdminBundle\Entity\Product $product)
    {
        $this->product->removeElement($product);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
