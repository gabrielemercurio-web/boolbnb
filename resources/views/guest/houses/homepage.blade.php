@extends('layouts.app')

@section('content')
	<div class="home-wrapper">
        <div class="container">
            <div class="home">
                <div class="home-img col-xs-12">
                    <img src="{{ asset('img/homepage.jpg') }}" class="img-fluid" alt="Responsive image">
                </div>
                <div class="home-search">
                    <input type="text" name="" value="" placeholder="Inserisci citta o regione">
                    <div class="icon">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
            <div class="title text-center">
                <h1>Appartamenti in Evidenza</h1>
                <hr>
            </div>
            <div class="apartment-description">
                @forelse ($houses as $house)
                    <div class="apartment col-4">
                        <div class="apartment-img">
                            <img src="{{ $house->image_path }}" class="img-fluid" alt="Responsive image">
                            <p>Sponsored</p>
                        </div>
                        <div class="description-apartment">
                            <h2>{{ $house->title }}</h2>
                            <p>{{ $house->description }}</p>
                            <a href="{{ route('guest.show', ['house' => $house->id]) }}">
                                <button type="button" class="btn btn-outline-primary btn-color">Vedi dettagli appartamento</button>
                            </a>
                        </div>
                    </div>
                @empty
                    -
                @endforelse
            </div>
        </div>
    </div>
@endsection
