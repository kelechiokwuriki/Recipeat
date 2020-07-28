<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recipe;
use App\User;
use App\Like;


class SavedRecipe extends Model
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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function scopeDidLoggedInUserSaveRecipe($query, $recipeId)
    {
        return $query->where('user_id', auth()->id())->where('recipe_id', $recipeId)->exists();
    }

    public function scopeGetSavedRecipeIdForRecipe($query, $recipeId)
    {
        return $query->where('recipe_id', $recipeId)->first()->id ?? 'null';
    }
}
