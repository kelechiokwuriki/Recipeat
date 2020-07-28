<?php

namespace App\Repositories\Ingredient;

use App\Ingredient;
use App\Repositories\BaseRepository;

class IngredientRepository extends BaseRepository
{
    protected $ingredientModel;

    public function __construct(Ingredient $ingredientModel)
    {
        parent::__construct($ingredientModel);
    }
}
