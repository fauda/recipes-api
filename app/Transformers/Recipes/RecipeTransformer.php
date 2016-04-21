<?php

namespace App\Transformers\Recipes;

use App\Models\Recipe;
use League\Fractal\TransformerAbstract;

class RecipeTransformer extends TransformerAbstract
{
    /**
     * @param Recipe $recipe
     * @return array
     */
    public function transform($recipe)
    {
        return [
            'id'                       => $recipe->getId(),
            'created_at'               => $recipe->getCreatedAt(),
            'updated_at'               => $recipe->getUpdatedAt(),
            'box_type'                 => $recipe->getBoxType(),
            'title'                    => $recipe->getTitle(),
            'slug'                     => $recipe->getSlug(),
            'short_title'              => $recipe->getShortTitle(),
            'marketing_description'    => $recipe->getMarketingDescription(),
            'calories_kcal'            => $recipe->getCaloriesKcal(),
            'protein_grams'            => $recipe->getProteinGrams(),
            'fat_grams'                => $recipe->getFatGrams(),
            'carbs_grams'              => $recipe->getCarbsGrams(),
            'bulletpoint1'             => $recipe->getBulletpoint1(),
            'bulletpoint2'             => $recipe->getBulletpoint2(),
            'bulletpoint3'             => $recipe->getBulletpoint3(),
            'recipe_diet_type_id'      => $recipe->getRecipeDietTypeId(),
            'season'                   => $recipe->getSeason(),
            'base'                     => $recipe->getBase(),
            'protein_source'           => $recipe->getProteinSource(),
            'preparation_time_minutes' => $recipe->getPreparationTimeMinutes(),
            'shelf_life_days'          => $recipe->getShelfLifeDays(),
            'equipment_needed'         => $recipe->getEquipmentNeeded(),
            'origin_country'           => $recipe->getOriginCountry(),
            'recipe_cuisine'           => $recipe->getRecipeCuisine(),
            'in_your_box'              => $recipe->getInYourBox(),
            'gousto_reference'         => $recipe->getGoustoReference(),
            'rating'                   => $recipe->getRating(),
        ];
    }
}