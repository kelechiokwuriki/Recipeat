<?php

namespace App\Services\Ingredient;


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
        $temp = [];

        foreach($recipeNames as $recipe) {
            $temp[] = $this->ingredientRepository->whereCompare('name', 'like', '%'.$recipe.'%')->get();
        }

        return json_encode($temp);
    }
}
