@extends('layouts.app')

@section('content')
	<div class="container">
        <div class="row">
            <div class="home col-12">
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

                <form action="">
                    @foreach ( $services as $service )
                        <div class="filter-box">
                            <input type="checkbox" id="{{ $service->name }}" name="{{ strtolower($service->name) }}">
                            <label for="">{{ $service->name }}</label>
                            <button type="submit" value="Submit">Apply Filters</button>
                        </div>
                    @endforeach
                </form>

            </div>
        </div>
    </div>

    <script id="filter-handle" type="text/x-handlebars-template">
        <div class="entry">
            <h1> @{{title}}</h1>
            <div class="body">
            @{{body}}
            </div>
        </div>
    </script>

@endsection
