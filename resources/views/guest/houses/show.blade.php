@extends('layouts.app')

@section('page-title', 'View Home | Boolbnb')

@section('content')
    <div class="container">
		@if(session()->has('message'))
			<div class="alert alert-success">
				{{ session()->get('message') }}
			</div>
		@endif
        <div class="row row-2">
			{{-- HOUSE IMAGE --}}
            <div id="slider" class="col-lg-6">
                <img class="images" src="{{ asset('storage/' . $house->image_path) }}" alt="img-house">
            </div>

			{{-- HOUSE INFO --}}
            <div class="text-house col-lg-6">
                <h1>{{ $house->title }} </h1>
                <small><i class="fas fa-map-marker-alt"></i>{{ $house->address }}</small>
            	<p>{{ $house->description }}</p>
                <div class="sevices d-flex flex-column flex-wrap">
                    <span><i class="fas fa-door-open"></i>Rooms: {{ $house->nr_of_rooms }}</span>
                    <span><i class="fas fa-bed"></i>Beds: {{ $house->nr_of_beds }}</span>
                    <span><i class="fas fa-bath"></i>Bathrooms: {{ $house->nr_of_bathrooms }}</span>
					<span><i class="fas fa-border-style"></i>m<sup>2</sup>: {{ $house->square_mt }}</span>
                    @foreach ($house->services as $service)
						<span><i class="{{$service->icon_class}}"></i> {{ucfirst($service->name)}} </span>
					@endforeach
                </div>
            </div>
        </div>
    </div>

	{{-- send message & map display --}}
    <section id="map-contact">
        <div class="container">
            <div class="row row-3">
				{{-- SEND MESSAGE --}}
                <div id="contact" class="col-md-5">
                    <h1>Contact the Owner</h1>
                <form method="POST" action="{{ route('guest.messages.store') }}" class="form-messages">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="house_id" value="{{ $house->id }}" hidden>
                    </div>

                    <div class="form-group">
                        @guest
    		                <input type="email" name="sender_email" class="form-control" id="sender-email" placeholder="Your email" required>
						@else
							<input type="email" name="sender_email" class="form-control" id="sender-email" value=" {{Auth::user()->email}} " required>
						@endguest
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" name="message" id="text-message-1" rows="3" placeholder="Your message" required></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn">Send</button>
                    </div>
                </form>
				</div>
				{{-- MAP --}}
				<div id="my-maps" class="col-md-6 offset-md-1" data-longitude="{{ $house->longitude }}" data-latitude="{{$house->latitude}}">
                    <div id="map"></div>
                </div>
            </div>
		</div>
    </section>
@endsection
