{{-- pagina dettagli singolo appartamento --}}
@extends('layouts.app-upr')

@section('content')

    <div class="container">
		{{-- SEARCHBAR --}}
        {{-- <div class="row row-1">
            <div class="col-lg-6 offset-lg-3">
                <form action="{{route(upr.houses.search)}}" method="GET" class="search-house input-group">
                    <input type="text" class="form-control" placeholder="Search..." aria-describedby="button-addon4">
                    <div class="input-group-append">
                        <button class="btn" type="submit" id="button-addon4"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div> --}}

        <div class="row row-2">
			{{-- IMAGE SLIDER --}}
            <div id="slider" class="col-lg-6">
                {{--
				<div class="images">
					<div class="prev">
						<i class="fas fa-chevron-circle-left"></i>
					</div>
					<div class="next">
						<i class="fas fa-chevron-circle-right"></i>
					</div>

                    @forelse ($houses as $house)
                        <img class="" src="{{-- $house->image_path --}}{{--" alt="img-house">
                        <div class="bullets">
                            <i class="fas fa-circle"></i>
                        </div>
                    @empty
                        <img class="" src="{{ asset('img/house-2.jpg')}}" alt="img-house">
                    @endforelse
                </div>
                --}}
                {{-- <img class="images" src="{{ $house->image_path }}" alt="img-house"> --}}
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
                    <h1>Contact Owner</h1>
                <form method="POST" action="{{ route('upr.messages.store') }}" name="form-validate" class="form-messages">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="house_id" value="{{ $house->id }}" hidden>
                    </div>
                    <div class="form-group">
                        <input required type="email" name="sender_email" class="form-control" id="sender-email" placeholder="Your email">
                    </div>
                    <div class="form-group">
                        <textarea required class="form-control" name="message" id="message" rows="3" placeholder="Your message"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn">Send</button>
                    </div>
                </form>
				</div>
				{{-- MAP --}}
				<div id="my-maps" class="col-md-6 offset-md-1" data-longitude="{{$house->longitude}}" data-latitude="{{$house->latitude}}">
                    <div id="map"></div>
                    {{-- <img src="https://www.worldeasyguides.com/wp-content/uploads/2013/01/Place-Vendome-on-Map-of-Paris.jpg" alt="Map"> --}}
                </div>

            </div>
		</div>
    </section>
@endsection