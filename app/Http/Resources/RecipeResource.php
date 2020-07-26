<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'ingredients' => $this->ingredients,
            'view_count' => $this->view_count,
            'cooking_time' => $this->cooking_time,
            'image_source' => $this->image_source,
            'user' => $this->user->name,
            'likes' => count($this->likes),
            'logged_in_user_liked_recipe' => $this->likes()->didLoggedInUserLikeRecipe($this->id),
            'slug' => $this->slug,
            'steps' => $this->steps
        ];
    }
}
