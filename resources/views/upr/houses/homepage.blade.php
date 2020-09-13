{{-- pagina di atterragio/homepage del sito con barra di ricerca  --}}
@extends('layouts.app-upr')

@section('content')
	<div class="home-wrapper">
		<div class="container">
			{{-- JUMBO --}}
			<div class="home">
				<div class="overlay"></div>
				<div class="col-lg-6">
					<form action="{{ route('upr.houses.search') }}" method="GET" class="search-house input-group">
						{{-- hidden input needed to recognize search source --}}
						<input type="text" name="search_source" value="guest-homepage" style="display:none">
						{{-- SEARCHBAR --}}
						<input type="text" class="form-control" placeholder="Search..." aria-describedby="button-addon3" name="user_search_address">
						<div class="input-group-append">
							<button class="btn" type="submit" id="button-addon3"><i class="fas fa-search"></i></button>
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
				<div class="row">
                    @forelse ($houses as $house)
                        <a href="{{route('upr.houses.show', ['house' => $house->id])}}" class="card-upr col-lg-4 col-md-6">
                            <img src="{{ asset('storage/' . $house->image_path) }}" alt="image of house" class="apartment-img">
                            <h1>{{ $house->title }}</h1>
                            <p>{{ $house->description }}</p>
                            <div class="sponsored d-flex justify-content-end">
                                <p>Sponsored</p>
                            </div>
                        </a>
                    @empty
                        <p>Your search returned no results.</p>
                    @endforelse
                </div>
            </div>
		</div>
	</div>
@endsection
