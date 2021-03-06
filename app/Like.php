<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\SavedRecipe;


class Like extends Model
{
    protected $guarded = [];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeDidLoggedInUserLikeRecipe($query, $recipeId)
    {
        return $query->where('user_id', auth()->id())->where('recipe_id', $recipeId)->exists();
    }

    public function scopeGetLikedRecipeIdForRecipe($query, $recipeId)
    {
        return $query->where('recipe_id', $recipeId)->first()->id ?? 'null';
    }
}
