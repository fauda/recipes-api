<?php

namespace App\Models;

class Recipe
{
    protected $id;
    protected $createdAt;
    protected $updatedAt;
    protected $boxType;
    protected $title;
    protected $slug;
    protected $shortTitle;
    protected $marketingDescription;
    protected $caloriesKcal;
    protected $proteinGrams;
    protected $fatGrams;
    protected $carbsGrams;
    protected $bulletpoint1;
    protected $bulletpoint2;
    protected $bulletpoint3;
    protected $recipeDietTypeId;
    protected $season;
    protected $base;
    protected $proteinSource;
    protected $preparationTimeMinutes;
    protected $shelfLifeDays;
    protected $equipmentNeeded;
    protected $originCountry;
    protected $recipeCuisine;
    protected $inYourBox;
    protected $goustoReference;
    protected $ratingTotal;
    protected $ratingCount;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getBoxType()
    {
        return $this->boxType;
    }

    public function setBoxType($boxType)
    {
        $this->boxType = $boxType;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    public function getShortTitle()
    {
        return $this->shortTitle;
    }

    public function setShortTitle($shortTitle)
    {
        $this->shortTitle = $shortTitle;
        return $this;
    }

    public function getMarketingDescription()
    {
        return $this->marketingDescription;
    }

    public function setMarketingDescription($marketingDescription)
    {
        $this->marketingDescription = $marketingDescription;
        return $this;
    }

    public function getCaloriesKcal()
    {
        return $this->caloriesKcal;
    }

    public function setCaloriesKcal($caloriesKcal)
    {
        $this->caloriesKcal = $caloriesKcal;
        return $this;
    }

    public function getProteinGrams()
    {
        return $this->proteinGrams;
    }

    public function setProteinGrams($proteinGrams)
    {
        $this->proteinGrams = $proteinGrams;
        return $this;
    }

    public function getFatGrams()
    {
        return $this->fatGrams;
    }

    public function setFatGrams($fatGrams)
    {
        $this->fatGrams = $fatGrams;
        return $this;
    }

    public function getCarbsGrams()
    {
        return $this->carbsGrams;
    }

    public function setCarbsGrams($carbsGrams)
    {
        $this->carbsGrams = $carbsGrams;
        return $this;
    }

    public function getBulletpoint1()
    {
        return $this->bulletpoint1;
    }

    public function setBulletpoint1($bulletpoint1)
    {
        $this->bulletpoint1 = $bulletpoint1;
        return $this;
    }

    public function getBulletpoint2()
    {
        return $this->bulletpoint2;
    }

    public function setBulletpoint2($bulletpoint2)
    {
        $this->bulletpoint2 = $bulletpoint2;
        return $this;
    }

    public function getBulletpoint3()
    {
        return $this->bulletpoint3;
    }

    public function setBulletpoint3($bulletpoint3)
    {
        $this->bulletpoint3 = $bulletpoint3;
        return $this;
    }

    public function getRecipeDietTypeId()
    {
        return $this->recipeDietTypeId;
    }

    public function setRecipeDietTypeId($recipeDietTypeId)
    {
        $this->recipeDietTypeId = $recipeDietTypeId;
        return $this;
    }

    public function getSeason()
    {
        return $this->season;
    }

    public function setSeason($season)
    {
        $this->season = $season;
        return $this;
    }

    public function getBase()
    {
        return $this->base;
    }

    public function setBase($base)
    {
        $this->base = $base;
        return $this;
    }

    public function getProteinSource()
    {
        return $this->proteinSource;
    }

    public function setProteinSource($proteinSource)
    {
        $this->proteinSource = $proteinSource;
        return $this;
    }

    public function getPreparationTimeMinutes()
    {
        return $this->preparationTimeMinutes;
    }

    public function setPreparationTimeMinutes($preparationTimeMinutes)
    {
        $this->preparationTimeMinutes = $preparationTimeMinutes;
        return $this;
    }

    public function getShelfLifeDays()
    {
        return $this->shelfLifeDays;
    }

    public function setShelfLifeDays($shelfLifeDays)
    {
        $this->shelfLifeDays = $shelfLifeDays;
        return $this;
    }

    public function getEquipmentNeeded()
    {
        return $this->equipmentNeeded;
    }

    public function setEquipmentNeeded($equipmentNeeded)
    {
        $this->equipmentNeeded = $equipmentNeeded;
        return $this;
    }

    public function getOriginCountry()
    {
        return $this->originCountry;
    }

    public function setOriginCountry($originCountry)
    {
        $this->originCountry = $originCountry;
        return $this;
    }

    public function getRecipeCuisine()
    {
        return $this->recipeCuisine;
    }

    public function setRecipeCuisine($recipeCuisine)
    {
        $this->recipeCuisine = $recipeCuisine;
        return $this;
    }

    public function getInYourBox()
    {
        return $this->inYourBox;
    }

    public function setInYourBox($inYourBox)
    {
        $this->inYourBox = $inYourBox;
        return $this;
    }

    public function getGoustoReference()
    {
        return $this->goustoReference;
    }

    public function setGoustoReference($goustoReference)
    {
        $this->goustoReference = $goustoReference;
        return $this;
    }

    public function getRatingTotal()
    {
        return $this->ratingTotal;
    }

    public function setRatingTotal($ratingTotal)
    {
        $this->ratingTotal = $ratingTotal;
        return $this;
    }

    public function getRatingCount()
    {
        return $this->ratingCount;
    }

    public function setRatingCount($ratingCount)
    {
        $this->ratingCount = $ratingCount;
        return $this;
    }

    public function getRating()
    {
        if($this->getRatingCount()) {
            return ($this->getRatingTotal() / $this->getRatingCount());
        }
    }
}