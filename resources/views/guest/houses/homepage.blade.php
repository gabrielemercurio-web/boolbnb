@extends('layouts.app')

@section('page-title', 'Homepage | Boolbnb')

@section('content')
	<div class="home-wrapper">
        <div class="container">
			{{-- JUMBO --}}
            <div class="home">
                <div class="overlay"></div>
                <div class="col-lg-6">
					<form action="{{ route('guest.search') }}" method="GET" class="search-house input-group">
						<input type="text" name="search_source" value="upr-homepage" style="display:none">
                        <input type="text" class="form-control" placeholder="Search..." aria-describedby="button-addon2" name="user_search_address">
                        <div class="input-group-append">
                            <button class="btn" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
			{{-- PROMOTED HOUSES LIST --}}
            <div class="title text-center">
                <h1>Homes you might enjoy</h1>
                <hr>
            </div>
            <div class="apartment-description">
				<div class="row">
                @foreach ($houses as $house)
                    <a href="{{route('guest.show', ['house' => $house->id])}}" class="card-upr col-lg-4 col-md-6">
                        <img src="{{ asset('storage/' . $house->image_path) }}" alt="image of house" class="apartment-img">
                        <h1>{{ $house->title }}</h1>
                        <p>{{ $house->description }}</p>
                        <div class="sponsored d-flex justify-content-end">
                            <p>Sponsored</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
		</div>
	</div>
@endsection
