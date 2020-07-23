<?php

namespace App\Services\Recipe;

use App\Recipe;
use App\Repositories\Recipe\RecipeRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RecipeService
{
    protected $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function getLatestThreeCreatedRecipes()
    {
        return $this->recipeRepository->getByOrderAndNumber('created_at', 'desc', 3)->with('user')->get();
    }

    public function getThreeMostPopularRecipes()
    {
        return $this->recipeRepository->getByOrderAndNumber('view_count', 'desc', 3)->with('user')->get();
    }

    public function createRecipe(array $recipe)
    {
        $cookingTime = $this->convertRecipeCookingTime($recipe['cooking_time'], $recipe['cooking_time_format']);

        $recipeAttributes = $this->transformRecipeData($recipe['name'], $recipe['ingredients'], $cookingTime);

        $recipeSaved = $this->recipeRepository->create($recipeAttributes);

        Log::debug($recipeSaved);
    }

    private function syncRecipeWithIngredients(Recipe $recipe, array $ingredients)
    {
        $ingredientIds = [];

        foreach($ingredients as $ingredient) {
            $ingredientIds[] = $this->ingredientService->saveIngredient($ingredient)->id;
        }

        //attach the ingredient to the recipe //many to many relationship
        $recipe->ingredients()->sync($ingredientIds);

    }

    private function transformRecipeData(string $recipeName, string $ingredients, string $cookingTime)
    {
        return [
            'name' => $recipeName,
            'ingredients' => $ingredients,
            'user_id' => auth()->id(),
            'view_count' => 0,
            'cooking_time' => $cookingTime,
            'image_source' => 'assets/images/gallery/food7.jpeg'
        ];
    }

    private function convertRecipeCookingTime(int $cookingTime, string $cookingTimeFormat)
    {
        $newTime = strlen($cookingTime) === 2 ? $cookingTime : '0'.$cookingTime;

        if($cookingTimeFormat === 'Minutes') {
            return '00:'.$newTime.':00';
        }

        if($cookingTimeFormat === 'Hours')
        {
            return $newTime.':00'.':00';
        }
    }
}
