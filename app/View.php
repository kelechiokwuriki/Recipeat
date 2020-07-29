<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recipe;

class View extends Model
{
    protected $guarded = [];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function scopeDidLoggedInUserLikeRecipe($query, $recipeId)
    {
        return $query->where('user_id', auth()->id())->where('recipe_id', $recipeId)->exists();
    }
}
