<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Step;
use App\Like;
use App\SavedRecipe;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Recipe extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function steps()
    {
        return $this->belongsToMany(Step::class, 'recipe_step', 'recipe_id', 'step_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function savedRecipe()
    {
        return $this->hasMany(SavedRecipe::class);
    }

    public function savedRecipeId()
    {
        return $this->HasOne(SavedRecipe::class);
    }
}
