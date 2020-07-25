@extends('layouts.app')

@section('content')
    <my-recipes-component :myrecipes="{{ $recipes }}"></my-recipes-component>
@endsection
