<?php

namespace App\Http\Controllers\Recipes;

use App\Http\Controllers\ApiController;
use App\Http\Requests\ParsedRequest;
use App\Http\Requests\Recipe\CreateRequest;
use App\Http\Requests\Recipe\UpdateRequest;
use App\Models\Recipe;
use App\Models\RecipeHandler;

class RecipesController extends ApiController
{
    /**
     * Recipe collection
     * @param ParsedRequest $parsedRequest
     * @return \Illuminate\Http\Response
     */
    public function index(ParsedRequest $parsedRequest)
    {
        return $this->getBasicListResponse(
            $this->getRecipeHandler()->fetchAll($parsedRequest),
            $parsedRequest
        );
    }

    /**
     * Show a recipe using an id
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->getItemResponse($this->getRecipeHandler()->fetchById($id));
    }

    /**
     * Save a new Recipe
     * @param CreateRequest $createRequest
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $createRequest)
    {
        /** @var Recipe $recipe */
        $recipe = $createRequest->getDeserializedContent();

        $this->getRecipeHandler()->save($recipe);

        return $this->getStoreResponse($recipe, 'recipes/' . $recipe->getId());
    }

    /**
     * Update a Recipe
     * @param $id
     * @param UpdateRequest $updateRequest
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateRequest $updateRequest)
    {
        /** @var Recipe $recipe */
        $recipe = $updateRequest->getDeserializedContent();
        $recipe->setId($id);

        $this->getRecipeHandler()->update($recipe);

        return $this->getItemResponse($recipe);
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
