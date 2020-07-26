<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Step;
use App\Like;

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
}
