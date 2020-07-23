<?php

namespace App\Services\Step;

use App\Recipe;
use App\Repositories\Step\StepRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RecipeService
{
    protected $stepRepository;

    public function __construct(StepRepository $stepRepository)
    {
        $this->stepRepository = $stepRepository;
    }

    public function saveSteps(array $steps)
    {

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
}
