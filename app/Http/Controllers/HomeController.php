<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeResource;
use App\Services\Recipe\RecipeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    protected $recipeService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RecipeService $recipeService)
    {
        $this->middleware('auth');

        $this->recipeService = $recipeService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $latestThreeRecipes = RecipeResource::collection($this->recipeService->getLatestThreeCreatedRecipes());

        $threeMostPopularRecipes = RecipeResource::collection($this->recipeService->getThreeMostPopularRecipes());


        return view('home')->with([
            'latestThreeRecipes' => json_encode($latestThreeRecipes),
            'threeMostPopularRecipes' => json_encode($threeMostPopularRecipes)
        ]);
    }
}
