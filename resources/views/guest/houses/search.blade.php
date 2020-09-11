@extends('layouts.app')

@section('content')
	<div class="container">
        <div class="row">
            <div class="home col-12">
                <div class="overlay"></div>
                <div class="col-lg-6">
					{{-- SEARCHBAR --}}
                    <form action="{{ route('guest.search') }}" method="GET" class="search-house input-group">
                        <input type="text" class="form-control searchbars" id="guest-search" placeholder="Search..." aria-describedby="searchbar" data-user-query="{{ $userQuery}} " data-coordinates-from="">
                        <div class="input-group-append">
                            <button class="btn" type="submit" id="guest-search-btn"><i class="fas fa-search" data-placement="searchguest"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- PROMOTED HOUSES LIST --}}
            <div class="title col-12">
                <h1>SEARCH RESULTS</h1>
                <hr>
            </div>
        </div>

                                        {{-- SEZIONE FILTRI --}}
        <div class="row">
            <div id="search-filter" class="">

                <form class="filter-form">
                    <input type="number" class="filter-box search-filters" name="rooms" placeholder="N. rooms...">
                    <input type="number" class="filter-box search-filters" name="beds" placeholder="N. beds...">
                    <input type="number" class="filter-box search-filters" name="distance" placeholder="Distance(km)...">
                    @foreach ( $services as $service )
                        <div class="filter-box">
                            <input type="checkbox" class="search-filters" id="{{ $service->name }}" name="{{ strtolower($service->name) }}">
                            <label for="">{{ $service->name }}</label>
                        </div>
                    @endforeach
                    {{-- <button type="submit" value="Submit">Apply Filters</button> --}}
                </form>

            </div>
        </div>
    </div> {{-- END CONTAINER --}}

                                    {{-- SEZIONE CASE SPONSORIZZATE --}}
    <div class="bg-sponsored">
        <div class="container">
            <div class="row">
                @forelse ($houses as $house)
                    <div class="card-upr col-lg-4 col-md-6">
                        <a href="{{-- route('guest.houses.show', ['houses' => $house->id]) --}}#">
                            <img src="{{ $house->image_path }}" alt="house">
                            <h1>{{ $house->title }}</h1>
                            <p>{{ $house->description }}</p>
                        </a>
                    </div>
                @empty
                    <p>Your search returned no results.</p>
                @endforelse ($houses as $house)
            </div>
        </div>
    </div>


                                    {{-- SEZIONE RISULTATI RICERCA --}}
    <div class="container">
        <div class="row houses-grid-results"> {{-- Cards delle Case provenienti da una chiamata AJAX in "search.js" --}}
            
        </div>
    </div>

                                    {{-- SCRIPT HANDLEBARS --}}

    <script id="house-card" type="text/x-handlebars-template">
        <div class="handle-house-card card-upr col-lg-4 col-md-6">
            <img src="@{{ image }}" alt="house">
            <div>
                <a href="@{{ route }}">
                    <h1>@{{ title }}</h1>
                </a>
                <p>@{{ description }}</p>
                <p>@{{ distance }}</p>
                
            </div>
        </div>
    </script>

@endsection
