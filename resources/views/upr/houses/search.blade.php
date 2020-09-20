@extends('layouts.app-upr')

@section('page-title', 'Search Homes | Boolbnb')

@section('content')
	<div class="container">
        <div class="row">
            <div class="home col-12">
                <div class="overlay"></div>
                <div class="col-lg-6">
					{{-- SEARCHBAR --}}
                    <form class="search-house input-group">
                        <input type="text" class="form-control searchbars" id="upr-search" placeholder="Search..." data-user-query="{{ $userQuery }}" data-search-source="{{ $source }}">
                        <div class="input-group-append">
                            <button type="button" class="btn search-btn"><i class="fas fa-search" data-placement="searchupr"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

		{{-- FILTERS --}}
        <div class="row">
            <div id="search-filter" class="">

                <form class="filter-form">
                    <input type="number" class="filter-box search-filters" name="rooms" placeholder="N. rooms...">
                    <input type="number" class="filter-box search-filters" name="beds" placeholder="N. beds...">
                    <input type="number" class="filter-box search-filters" name="distance" placeholder="Distance(km)...">
                    @foreach ( $services as $service )
                        <div class="filter-box">
                            <input type="checkbox" class="search-filters" value="{{ $service->id) }}" name="services">
                            <label for="">{{ $service->name }}</label>
                        </div>
                    @endforeach
                    <button type="button" class="search-update-btn">Apply Filters</button>
                </form>

            </div>
        </div>
    </div> {{-- END CONTAINER --}}

    {{-- ADVERTISED HOMES --}}
    <div class="bg-sponsored">
        <div class="container">
            <div class="row">
                @foreach ($houses as $house)
                    <a href="{{route('guest.show', ['house' => $house->id])}}" class="card-upr col-lg-4 col-md-6">
                        <img src="{{ asset('storage/' . $house->image_path) }}" alt="house">
                        <h1>{{ $house->title }}</h1>
                        <p>{{ $house->description }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>


    {{-- SEARCH RESULTS - filled by Handlebars after ajax call to the internal API --}}
    <div class="container">
        <div class="row houses-grid-results">

        </div>
    </div>

    {{-- HANDLEBARS TEMPLATE --}}
    <script class="house-card-template" type="text/x-handlebars-template">
        <div class="handle-house-card card-upr col-lg-4 col-md-6">
            <img src="{{ asset('storage')}}/@{{image}}" alt="house">
            <div>
                <a href="@{{ route }}">
                    <h1 class="hbs-title">@{{ title }}</h1>
                </a>
                <p class="hbs-description">@{{ description }}</p>
                <p class="hbs-distance">@{{ distance }}</p>
                <p class="hbs-id">@{{ id }}</p>
            </div>
        </div>
    </script>

@endsection
