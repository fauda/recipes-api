<?php

namespace App\Http\Controllers\Recipes;

use App\Http\Controllers\ApiController;
use App\Http\Requests\RecipeRating\CreateRequest;
use App\Models\RecipeHandler;

class RecipeRatingsController extends ApiController
{
    /**
     * @param $id
     * @param CreateRequest $createRequest
     * @return mixed
     */
    public function store($id, CreateRequest $createRequest)
    {
        $recipe = $this->getRecipeHandler()->fetchById($id);

        $recipe
            ->setRatingCount($recipe->getRatingCount() + 1)
            ->setRatingTotal($recipe->getRatingTotal() + $createRequest->getDeserializedContent());

        $this->getRecipeHandler()->update($recipe);

        return $this->getStoreArrayResponse(
            ['data' => ['rating' => $createRequest->getDeserializedContent()]]
        );
    }

    /**
     * Fetch RecipeHandler from service providers which manipulates the csv
     * @return RecipeHandler
     */
    public function getRecipeHandler() : RecipeHandler
    {
        return $this->app->make(RecipeHandler::class);
    }
}