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
@endsection
