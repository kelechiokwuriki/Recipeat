<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

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
}
