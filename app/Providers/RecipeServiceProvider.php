<?php

namespace App\Providers;

use App\Models\RecipeHandler;
use Illuminate\Support\ServiceProvider;
use League\Csv\Reader;

class RecipeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(RecipeHandler::class, function() {
            $path = storage_path('app/recipes.csv');

            $recipeFactory = new RecipeHandler(Reader::createFromPath($path));

            return $recipeFactory;
        });
    }
}