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
                <div class="apartment col-4">
                    <div class="apartment-img">
                        <img src="{{ asset('img/homepage.jpg') }}" class="img-fluid" alt="Responsive image">
                        <p>Sponsered</p>
                    </div>
                    <div class="description-apartment">
                        <h2>Titolo</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="apartment-due col-4">
                    <div class="apartment-img">
                        <p>Sponsered</p>
                    </div>
                    <div class="description-apartment">
                        <h2>Titolo</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="apartment-tre col-4">
                    <div class="apartment-img">
                        <p>Sponsered</p>
                    </div>
                    <div class="description-apartment">
                        <h2>Titolo</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
            </div>
            <div class="apartment-description secondo-appartamento">
                <div class="apartment col-4">
                    <div class="apartment-img">
                        <p>Sponsered</p>
                    </div>
                    <div class="description-apartment">
                        <h2>Titolo</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="apartment-due col-4">
                    <div class="apartment-img">
                        <p>Sponsered</p>
                    </div>
                    <div class="description-apartment">
                        <h2>Titolo</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="apartment-tre col-4">
                    <div class="apartment-img">
                        <p>Sponsered</p>
                    </div>
                <div class="description-apartment">
                    <h2>Titolo</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
