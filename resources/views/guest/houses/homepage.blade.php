@extends('layouts.app')

@section('content')
	<div class="home-wrapper">
        <div class="container">
			{{-- JUMBO --}}
            <div class="home">
                <div class="home-img col-xs-12">
                    <img src="{{ asset('img/homepage.jpg') }}" class="img-fluid" alt="image of a house">
				</div>
				{{-- SEARCHBAR --}}
                <div class="home-search">
                    <input type="text" id="homepage-house-search" name="" value="" placeholder="City or Address">
                    <div class="icon search-icon-hook">
                        <i class="fas fa-search" data-placement="guest-homepage"></i>
                    </div>
                </div>
			</div>
			{{-- PROMOTED HOUSES LIST --}}
            <div class="title text-center">
                <h1>Places you might enjoy</h1>
                <hr>
            </div>
            <div class="apartment-description">
                @forelse ($houses as $house)
                    <div class="apartment col-4">
                        <div class="apartment-img">
                            <img src="{{ $house->image_path }}" class="img-fluid" alt="image of the house">
                            <p>Sponsored</p>
                        </div>
                        <div class="description-apartment">
                            <h2>{{ $house->title }}</h2>
                            <p>{{ $house->description }}</p>
                            <a href="{{ route('guest.show', ['house' => $house->id]) }}">
                                <button type="button" class="btn btn-outline-primary btn-color">Access house details</button>
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
