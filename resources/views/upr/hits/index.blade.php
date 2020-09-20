@extends('layouts.app-upr')

@section('page-title', 'View Stats | Boolbnb')

@section('content')

	<div class="title text-center">
		<h1 data-house-id="{{ $house->id }}">Stats for {{ $house->title }} </h1>
		<hr class="offset-sm-1 col-sm-10 offset-md-2 col-md-8">
	</div>

	<div id="stats-hits-container" class="offset-sm-1 col-sm-10 offset-md-2 col-md-8">
		<canvas id="canvas-hits"></canvas>
	</div>
	<div id="stats-messages-container" class="offset-sm-1 col-sm-10 offset-md-2 col-md-8">
    	<canvas id="canvas-messages"></canvas>
	</div>
@endsection