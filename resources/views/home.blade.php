@extends('layouts.app')

@section('content')
        <home-component :recipes="{{ $recipes }}"></home-component>
        {{-- <latest-recipes :latestthreerecipes="{{ $latestThreeRecipes }}"></latest-recipes>

        <most-popular-recipes :threemostpopularrecipes="{{ $threeMostPopularRecipes }}"></most-popular-recipes> --}}
@endsection
