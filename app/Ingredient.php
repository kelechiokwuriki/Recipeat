<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recipe;

class Ingredient extends Model
{
    protected $guarded = [];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'ingredient_recipe', 'ingredient_id', 'recipe_id');
    }

    // public function scopeGetIngredientName($query)
    // {
    //     return $
    // }
}
