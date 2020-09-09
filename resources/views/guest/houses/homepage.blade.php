@extends('layouts.app')

@section('content')
	<div class="home-wrapper">
        <div class="container">
			{{-- JUMBO --}}
            <div class="home">
                <div class="overlay"></div>
                <div class="col-lg-6">
                    <form action="route{{ ('') }}" method="GET" class="search-house input-group">
                        <input type="text" class="form-control" placeholder="Search..." aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
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
                            <a href="{{ route('guest.houses.show', ['house' => $house->id]) }}">
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
