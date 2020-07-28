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
            'ingredients' => $this->recipeIngredients()->get()->pluck('name'),
            'view_count' => $this->view_count,
            'cooking_time' => $this->cooking_time,
            'image_source' => $this->image_source,
            'user' => $this->user->name,
            'likes' => $this->likes ? count($this->likes) : null,
            'saved_recipe_id' => $this->savedRecipeId ? $this->savedRecipeId()->getSavedRecipeIdForRecipe($this->id) : null,
            'liked_recipe_id' => $this->likes()->getLikedRecipeIdForRecipe($this->id),
            'logged_in_user_liked_recipe' => $this->likes()->didLoggedInUserLikeRecipe($this->id),
            'logged_in_user_saved_recipe' => $this->savedRecipe()->didLoggedInUserSaveRecipe($this->id),
            'slug' => $this->slug,
            'steps' => $this->steps
        ];
    }
}
