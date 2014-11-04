<?php

namespace MK\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="mk_language")
 * @ORM\Entity(repositoryClass="MK\AdminBundle\Repository\LanguageRepository")
 */
class Language
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
    private $name;
    
    /**
     * @ORM\Column(name="content", type="string")
     */
    private $langKey;
    
    /**
     * @ORM\Column(name="is_default_frontend", type="boolean")
     */
    private $isDefaultFrontend;
    
    /**
     * @ORM\Column(name="is_default_backend", type="boolean")
     */
    private $isDefaultBackend;

    public function __construct()
    {
        $this->isDefaultBackend = false;
        $this->isDefaultFrontend = false;
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
     * @return Language
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
     * Set langKey
     *
     * @param string $langKey
     * @return Language
     */
    public function setLangKey($langKey)
    {
        $this->langKey = $langKey;

        return $this;
    }

    /**
     * Get langKey
     *
     * @return string 
     */
    public function getLangKey()
    {
        return $this->langKey;
    }

    /**
     * Set isDefaultFrontend
     *
     * @param boolean $isDefaultFrontend
     * @return Language
     */
    public function setIsDefaultFrontend($isDefaultFrontend)
    {
        $this->isDefaultFrontend = $isDefaultFrontend;

        return $this;
    }

    /**
     * Get isDefaultFrontend
     *
     * @return boolean 
     */
    public function getIsDefaultFrontend()
    {
        return $this->isDefaultFrontend;
    }

    /**
     * Set isDefaultBackend
     *
     * @param boolean $isDefaultBackend
     * @return Language
     */
    public function setIsDefaultBackend($isDefaultBackend)
    {
        $this->isDefaultBackend = $isDefaultBackend;

        return $this;
    }

    /**
     * Get isDefaultBackend
     *
     * @return boolean 
     */
    public function getIsDefaultBackend()
    {
        return $this->isDefaultBackend;
    }
}
