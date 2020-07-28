<?php

namespace App\Services\Recipe;

use App\Recipe;
use App\Repositories\Ingredient\IngredientRepository;
use App\Repositories\Like\LikeRepository;
use App\Repositories\Recipe\RecipeRepository;
use App\Repositories\SavedRecipe\SavedRecipeRepository;
use App\Repositories\Step\StepRepository;
use App\Services\Like\LikeService;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RecipeService
{
    protected $recipeRepository;
    protected $stepRepository;
    protected $savedRecipeRepository;
    protected $likeRepository;
    protected $ingredientRepository;

    public function __construct(RecipeRepository $recipeRepository,
    StepRepository $stepRepository, SavedRecipeRepository $savedRecipeRepository,
    LikeRepository $likeRepository, IngredientRepository $ingredientRepository)
    {
        $this->recipeRepository = $recipeRepository;
        $this->stepRepository = $stepRepository;
        $this->savedRecipeRepository = $savedRecipeRepository;
        $this->likeRepository = $likeRepository;
        $this->ingredientRepository = $ingredientRepository;
    }

    public function getLatestThreeCreatedRecipes()
    {
        return $this->recipeRepository->getByOrderAndNumber('created_at', 'desc', 3)->get();
    }

    public function getThreeMostPopularRecipes()
    {
        return $this->recipeRepository->getByOrderAndNumber('view_count', 'desc', 3)->with(['user', 'likes'])->get();
    }

    public function getSavedRecipesForLoggedInUser()
    {
        return $this->savedRecipeRepository->where('user_id', auth()->id())->get();
    }

    public function createSavedRecipe(array $savedRecipe)
    {
        return $this->savedRecipeRepository->create($savedRecipe);
    }

    public function deleteSavedRecipe(int $savedRecipeId)
    {
        return $this->savedRecipeRepository->delete($savedRecipeId);
    }

    public function likeRecipe(array $like)
    {
        return $this->likeRepository->create($like);
    }

    public function deleteLikedRecipe(int $recipeId)
    {
        return $this->likeRepository->delete($recipeId);
    }

    public function getRecipeBySlug(string $slug)
    {
        return $this->recipeRepository->where('slug', $slug)->with(['steps', 'user', 'likes'])->first();
    }

    public function getRecipesForUser(int $userId)
    {
        return $this->recipeRepository->where('user_id', $userId)->with(['steps', 'likes'])->get();
    }

    public function createRecipe(array $recipe)
    {
        $cookingTime = $this->convertRecipeCookingTime($recipe['cooking_time'], $recipe['cooking_time_format']);

        $recipeAttributes = $this->transformRecipeData($recipe['name'], $recipe['ingredients'], $cookingTime);

        $savedRecipe = $this->recipeRepository->create($recipeAttributes);

        $ingredientsArray = explode(",", $recipe['ingredients']);

        $this->syncRecipeWithIngredients($savedRecipe, $ingredientsArray);

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

    private function syncRecipeWithIngredients(Recipe $recipe, array $ingredients)
    {
        $ingredientIds = [];

        foreach($ingredients as $ingredient) {
            $ingredientIds[] = $this->ingredientRepository->create([
                'name' => $ingredient
            ])->id;
        }

        return $recipe->recipeIngredients()->sync($ingredientIds);
    }

    private function transformRecipeData(string $recipeName, string $ingredients, string $cookingTime)
    {
        return [
            'name' => $recipeName,
            'ingredients' => $ingredients,
            'user_id' => auth()->id(),
            'view_count' => 0,
            'cooking_time' => $cookingTime,
            'image_source' => 'assets/images/gallery/food7.jpeg',
            'slug' => preg_replace('/\s+/', '-', strtolower($recipeName)).'-'.Carbon::now()->timestamp
        ];
    }

    private function convertRecipeCookingTime(int $cookingTime, string $cookingTimeFormat)
    {
        //e.g 10 should be to but 5 should be 05
        $newTime = strlen($cookingTime) === 2 ? $cookingTime : '0'.$cookingTime;

        if($cookingTimeFormat === 'Minutes') {
            $newTime = '00:'.$newTime.':00';
        }

        if($cookingTimeFormat === 'Hours')
        {
            $newTime = $newTime.':00'.':00';
        }

        return CarbonInterval::createFromFormat('H:i:s', $newTime);
    }
}
