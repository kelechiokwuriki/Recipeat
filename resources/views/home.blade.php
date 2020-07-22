@extends('layouts.app')

@section('content')
    <div class="mt-1">
        <latest-recipes :latestthreerecipes="{{ $latestThreeRecipes }}"></latest-recipes>

        <most-popular-recipes :threemostpopularrecipes="{{ $threeMostPopularRecipes }}"></most-popular-recipes>
    </div>

@endsection
