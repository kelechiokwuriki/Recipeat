@extends('layouts.app')

@section('content')
    <saved-recipes-component :savedrecipes="{{ $savedRecipes }}"></saved-recipes-component>
@endsection
