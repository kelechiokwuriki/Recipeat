<?php

namespace App\Services\Recipe;

use App\Recipe;
use App\Repositories\Recipe\RecipeRepository;
use App\Repositories\Step\StepRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RecipeService
{
    protected $recipeRepository;
    protected $stepRepository;

    public function __construct(RecipeRepository $recipeRepository, StepRepository $stepRepository)
    {
        $this->recipeRepository = $recipeRepository;
        $this->stepRepository = $stepRepository;
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

        $savedRecipe = $this->recipeRepository->create($recipeAttributes);

        return $this->syncRecipeWithSteps($savedRecipe, $recipe['steps']);
    }

    private function syncRecipeWithSteps(Recipe $recipe, array $steps)
    {
        $stepIds = [];

        foreach($steps as $step) {
            $stepIds[] = $this->stepRepository->create([
                'step' => $step['step']
            ])->id;
        }

        //attach the steps to the recipe //many to many relationship
        return $recipe->steps()->sync($stepIds);
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
