<?php

namespace MK\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="mk_category")
 * @ORM\Entity(repositoryClass="MK\AdminBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(name="name", type="string", length=256)
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     **/
    private $product;
    
    
    public function __construct() {
        $this->features = new ArrayCollection();
    }
    
    public function __toString() {
        return (String) $this->name;
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
     * @return Category
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
     * Add product
     *
     * @param \MK\AdminBundle\Entity\Product $product
     * @return Category
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
