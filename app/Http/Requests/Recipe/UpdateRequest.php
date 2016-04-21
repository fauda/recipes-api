<?php

namespace App\Http\Requests\Recipe;

use App\Http\Requests\AbstractRequest;
use App\Models\Recipe;

class UpdateRequest extends AbstractRequest
{
    protected $type = Recipe::class;

    public function rules() : array
    {
        return [
            'box_type' => ['required', 'string'],
            'title' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'short_title' => [],
            'marketing_description' => ['required', 'string'],
            'calories_kcal' => ['required', 'integer'],
            'protein_grams' => ['required', 'integer'],
            'fat_grams' => ['required', 'integer'],
            'carbs_grams' => ['required', 'integer'],
            'bulletpoint1' => [],
            'bulletpoint2' => [],
            'bulletpoint3' => [],
            'recipe_diet_type_id' => ['required', 'integer'],
            'season' => ['required', 'string'],
            'base' => [],
            'protein_source' => ['required', 'string'],
            'preparation_time_minutes' => ['required', 'integer'],
            'shelf_life_days' => ['required', 'integer'],
            'equipment_needed' => ['required', 'string'],
            'origin_country' => ['required', 'string'],
            'recipe_cuisine' => ['required', 'string'],
            'in_your_box' => [],
            'gousto_reference' => ['required', 'integer'],
        ];
    }

    public function authorize() : bool
    {
        return true;
    }

    public function getDeserializedContent()
    {
        $recipe = new Recipe();

        $recipe
            ->setBoxType($this->request->get('box_type'))
            ->setTitle($this->request->get('title'))
            ->setSlug($this->request->get('slug'))
            ->setShortTitle($this->request->get('short_title'))
            ->setMarketingDescription($this->request->get('marketing_description'))
            ->setCaloriesKcal($this->request->get('calories_kcal'))
            ->setProteinGrams($this->request->get('protein_grams'))
            ->setFatGrams($this->request->get('fat_grams'))
            ->setCarbsGrams($this->request->get('carbs_grams'))
            ->setBulletpoint1($this->request->get('bulletpoint1'))
            ->setBulletpoint2($this->request->get('bulletpoint2'))
            ->setBulletpoint3($this->request->get('bulletpoint3'))
            ->setRecipeDietTypeId($this->request->get('recipe_diet_type_id'))
            ->setSeason($this->request->get('season'))
            ->setBase($this->request->get('base'))
            ->setProteinSource($this->request->get('protein_source'))
            ->setPreparationTimeMinutes($this->request->get('preparation_time_minutes'))
            ->setShelfLifeDays($this->request->get('shelf_life_days'))
            ->setEquipmentNeeded($this->request->get('equipment_needed'))
            ->setOriginCountry($this->request->get('origin_country'))
            ->setRecipeCuisine($this->request->get('recipe_cuisine'))
            ->setInYourBox($this->request->get('in_your_box'))
            ->setGoustoReference($this->request->get('gousto_reference'));


        return $recipe;
    }
}