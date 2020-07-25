@extends('layouts.app')

@section('content')
        <latest-recipes :latestthreerecipes="{{ $latestThreeRecipes }}"></latest-recipes>

        <most-popular-recipes :threemostpopularrecipes="{{ $threeMostPopularRecipes }}"></most-popular-recipes>
@endsection
