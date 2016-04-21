<?php

return [
    'resource' => [
        'recipes'         => App\Http\Controllers\Recipes\RecipesController::class,
        'recipes.ratings' => App\Http\Controllers\Recipes\RecipeRatingsController::class,
    ],
];
