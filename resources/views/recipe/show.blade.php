@extends('layouts.app')

@section('content')
<single-recipe-component :recipe="{{ $recipe }}"></single-recipe-component>
@endsection
