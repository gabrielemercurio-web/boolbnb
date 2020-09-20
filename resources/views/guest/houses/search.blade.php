@extends('layouts.app')

@section('page-title', 'Search Homes | Boolbnb')

@section('content')
        <div class="container">
            <div class="row">
                <div class="jumbo-search col-12">
                    <div class="overlay"></div>
                    <div class="col-lg-6">
                        {{-- SEARCHBAR --}}
                        <form class="search-house input-group">
                            <input type="text" class="form-control searchbars" id="guest-search" placeholder="Search City"data-user-query="{{ $userQuery }}">
                            <div class="input-group-append">
                                <button type="button" class="btn search-btn" id="guest-search-btn"><i class="fas fa-search search-btn" data-placement="searchguest"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> {{-- END CONTAINER --}}

        {{-- ADVERTISED HOMES --}}
        <div class="container">
            <div class="row bg-sponsored">
                @forelse ($houses as $house)
                    <a href="{{route('guest.show', ['house' => $house->id])}}" class="card-upr card-upr-sponsored col-lg-4 col-md-6">
                        <img src="{{ asset('storage/' . $house->image_path) }}" alt="image-of-house">
                        <h1>{{ $house->title }}</h1>
                        <p>{{ $house->description }}</p>
                        <div class="sponsored d-flex justify-content-end">
                            <p>Sponsored</p>
                        </div>
                    </a>
                @empty
                    <p>Your search returned no results.</p>
                @endforelse ($houses as $house)
            </div>
        </div>


	{{-- SEARCH RESULTS - filled by Handlebars after ajax call to the internal API --}}
    <div class="container">
        {{-- PROMOTED HOUSES LIST --}}
        <div class="row">
            <div class="title">
                <h1>SEARCH RESULTS</h1>
                <hr>
            </div>
        </div>

        {{-- FILTERS --}}
        <div class="row">
            <div id="search-filter">

                <div class="btn-filters">
                    <i class="fas fa-sliders-h"></i>
                    <span>Filter homes</span>
                </div>

                <div class="bg-filters-form"></div>
                <form class="form">
                    <input type="number" min="1" class="filter-box search-filters" name="services" placeholder="N. rooms..." id="filter-rooms">
                    <input type="number" min="1" class="filter-box search-filters" name="services" placeholder="N. beds..." id="filter-beds">
                    <input type="number" min="1" class="filter-box search-filters" name="services" placeholder="Distance(km)..." id="filter-distance">
                    @foreach ( $services as $service )
                        <div class="filter-box">
                            <input type="checkbox" class="search-filters" id="{{$service->name}}" value="{{ $service->id }}" name="services">
                            <label for="">{{ $service->name }}</label>
                        </div>
                    @endforeach
                    <button type="button" class="search-update-btn">Apply Filters</button>
                </form>

            </div>
        </div>

        <div class="row houses-grid-results">
            {{-- SEARCH RESULTS --}}
        </div>

    </div>

    {{-- HANDLEBARS TEMPLATE --}}
    <script class="house-card-template" type="text/x-handlebars-template">
        <a href="@{{ route }}" class="handle-house-card card-upr col-lg-4 col-md-6">
            <img src="{{ asset('storage')}}/@{{image}}" alt="house">
            <span>
                <h1 class="hbs-title">@{{ title }}</h1>
                <p class="hbs-description">@{{ description }}</p>
                <p class="hbs-distance">@{{ distance }}</p>
                <p class="hbs-id">@{{ id }}</p>
            </span>
        </a>
    </script>

@endsection
