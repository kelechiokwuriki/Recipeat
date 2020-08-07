<?php

namespace App\Services\Ingredient;

use App\Http\Resources\IngredientResource;
use App\Http\Resources\RecipeResource;
use App\Recipe;
use App\Repositories\Ingredient\IngredientRepository;
use Illuminate\Support\Facades\Log;

class IngredientService
{
    protected $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function transformIngredientStringToArray(string $ingredient)
    {
        return explode(",", $ingredient);
    }

    public function searchForRecipesbyNames($recipeNames)
    {
        $tempIngredientsArr = [];
        $recipes = [];

        foreach($recipeNames as $recipe) {
            $foundIngredients = $this->ingredientRepository->whereCompare('name', 'like', '%'.$recipe.'%')->with('recipes')->get();

            $tempIngredientsArr[] = $foundIngredients;
        }


        foreach($tempIngredientsArr as $ingredients) {
            foreach($ingredients as $ing) {
                foreach($ing['recipes'] as $rec) {
                    $recipes[] = new RecipeResource($rec);
                }
            }
        }

        return $recipes;
    }
}
