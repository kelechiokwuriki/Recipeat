<?php

namespace App\Services\Recipe;

use App\Repositories\Recipe\RecipeRepository;
use Illuminate\Support\Collection;

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
}
