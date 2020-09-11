@extends('layouts.app-upr')


@section('content')

    <h1 data-house-id="{{ $house->id }}">Statistics House {{ $house->id }} </h1>

    <h2>Total Messages: {{ $count_messages }}</h2>

    <h2>Total Hits: {{ $count_hits }}</h2>

    <canvas id="canvas-hits"></canvas>
    <canvas id="canvas-messages"></canvas>
    
@endsection