<?php
namespace App\Entity;

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
}