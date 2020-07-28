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
}
