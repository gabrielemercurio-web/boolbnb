@extends('layouts.app')

@section('page-title', 'View Stats | Boolbnb')

@section('content')

    <div class="container">
        <div id="title-stats" class="title text-center">
            <h1 data-house-id="{{ $house->id }}">Stats for {{ $house->title }} </h1>
            <hr>
        </div>

        <div id="stats-hits-container">
            <canvas id="canvas-hits" class="offset-sm-1 col-sm-10"></canvas>
        </div>
        <div id="stats-messages-container">
            <canvas id="canvas-messages" class="offset-sm-1 col-sm-10 "></canvas>
        </div>
    </div>
@endsection