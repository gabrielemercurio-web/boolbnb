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
        <div class="row">
            <div class="col-10 offset-1">

                <form action="" class="filter-form" style="display:block">
					<div class="filter-box">
						<input type="number" class="search-filters" name="rooms">
						<input type="number" class="search-filters" name="beds">
						<input type="number" class="search-filters" name="distance">
					</div>
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

        {{--  Case sponsorizzate --}}

        <div class="row houses-grid-results"> {{-- Cards delle Case provenienti da una chiamata AJAX in "search.js" --}}
            {{-- @forelse ($houses as $house) --}}

            {{-- @empty --}}
            {{-- @endforelse --}}
        </div>
    </div>

    {{-- <script id="house-card" type="text/x-handlebars-template">
        <div class="handle-house-card card-upr col-lg-4 col-md-6">
            <img src="@{{}}" alt="house">
            <div>
                <a href="route('upr.houses.show', ['house' => $house->id])#">
                    <h1>@{{}}</h1>
                </a>
                <p>@{{}}</p>
            </div>
        </div>
    </script> --}}

@endsection
