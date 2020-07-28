<?php

namespace App\Repositories\SavedRecipe;

use App\Repositories\BaseRepository;
use App\SavedRecipe;

class SavedRecipeRepository extends BaseRepository
{
    protected $savedRecipeModel;

    public function __construct(SavedRecipe $savedRecipe)
    {
        parent::__construct($savedRecipe);
    }
}
