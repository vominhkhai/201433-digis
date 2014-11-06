<?php

namespace MK\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use MK\CommonBundle\Utilities\Utilities;

/**
 * @ORM\Table(name="mk_product")
 * @ORM\Entity(repositoryClass="MK\AdminBundle\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 */
class Product
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(name="excerpt", type="text")
     */
    private $excerpt;
    
    /**
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    
    /**
     * @ORM\Column(name="price", type="integer")
     */
    private $price;
    
    /**
     * @ORM\Column(name="discount", type="float")
     */
    private $discount;
    
    /**
     * @ORM\Column(name="old_price", type="integer")
     */
    private $oldPrice;
    
    /**
     * @ORM\Column(type="string", length=64)
     */
    private $title;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;
    
    private $file;
    
    private $temp;
    
    /**
     * @ORM\ManyToMany(targetEntity="ProductColor", inversedBy="product")
     * @ORM\JoinTable(name="mk_product_product_color")
     **/
    private $productColor;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="product")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     **/
    private $category;
    
    public function __construct() {
        $this->productColor = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set excerpt
     *
     * @param string $excerpt
     * @return Product
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get excerpt
     *
     * @return string 
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Product
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set discount
     *
     * @param float $discount
     * @return Product
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return float 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set oldPrice
     *
     * @param integer $oldPrice
     * @return Product
     */
    public function setOldPrice($oldPrice)
    {
        $this->oldPrice = $oldPrice;

        return $this;
    }

    /**
     * Get oldPrice
     *
     * @return integer 
     */
    public function getOldPrice()
    {
        return $this->oldPrice;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * 
     * @return string
     */
    public function getThumbImage()
    {
        return Utilities::getImage("thumb_".$this->image, $this->getUploadRootDir(), $this->getUploadDir());
    }
    
        public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return '/uploads/products/';
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->image)) {
            // store the old name to delete after the update
            $this->temp = $this->image;
            $this->image = null;
        } else {
            $this->image = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function upload()
    {
        Utilities::uploadImage($this->file, $this->image, $this->getUploadRootDir());
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        Utilities::removeImage($this->image, $this->getUploadRootDir());
    }

    /**
     * Add productColor
     *
     * @param \MK\AdminBundle\Entity\ProductColor $productColor
     * @return Product
     */
    public function addProductColor(\MK\AdminBundle\Entity\ProductColor $productColor)
    {
        $this->productColor[] = $productColor;

        return $this;
    }

    /**
     * Remove productColor
     *
     * @param \MK\AdminBundle\Entity\ProductColor $productColor
     */
    public function removeProductColor(\MK\AdminBundle\Entity\ProductColor $productColor)
    {
        $this->productColor->removeElement($productColor);
    }

    /**
     * Get productColor
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductColor()
    {
        return $this->productColor;
    }

    /**
     * Set category
     *
     * @param \MK\AdminBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\MK\AdminBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \MK\AdminBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
