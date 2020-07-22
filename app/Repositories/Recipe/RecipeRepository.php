<?php

namespace App\Repositories\Recipe;

use App\Recipe;
use App\Repositories\BaseRepository;

class RecipeRepository extends BaseRepository
{
    protected $recipeModel;

    public function __construct(Recipe $recipeModel)
    {
        parent::__construct($recipeModel);

        $this->recipeModel = $recipeModel;
    }

    // public function getLatestRecipesByNumberAndOrder(string $column, int $number)
    // {
    //     return $this->recipeModel->orderBy($column)->take($number)->get();
    // }
}
