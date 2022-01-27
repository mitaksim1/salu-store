<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

// Cette entité n'es pas reliée à la base de données
// Elle ne permettra de créer un système de recherche
// cf. le form crée ClothesSearchType
class ClothesSearch
{
    /**
     * Search clothes by max price
     *
     * @var int|null
     * @Assert\Range(min=32, max=56)
     */
    private $size;

    /**
     * Search clothes by max price
     *
     * @var int|null
     * @Assert\Range(min=1)
     */
    private $maxPrice;

    /**
     * Search clothes by category
     *
     * @var ArrayCollection
     */
    private $categories;
       
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * Get search clothes by max price
     *
     * @return  int|null
     */ 
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * Set search clothes by max price
     *
     * @param  int|null  $maxPrice  Search clothes by max price
     *
     * @return  self
     */ 
    public function setMaxPrice(int $maxPrice)
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * Get search clothes by max price
     *
     * @return  int|null
     */ 
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set search clothes by max price
     *
     * @param  int|null  $size  Search clothes by max price
     *
     * @return  self
     */ 
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get search clothes by category
     *
     * @return  ArrayCollection
     */ 
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set search clothes by category
     *
     * @param  ArrayCollection  $categories  Search clothes by category
     *
     * @return  self
     */ 
    public function setCategories(ArrayCollection $categories)
    {
        $this->categories = $categories;

        return $this;
    }
}