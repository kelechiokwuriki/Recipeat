<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recipe;

class Step extends Model
{
    protected $guarded = [];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_step', 'step_id', 'recipe_id');
    }
}
