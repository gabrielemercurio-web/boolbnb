@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row row-1">
            <div class="col-6 offset-3">
                <div class="search-house input-group">
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-2">
            <div class="image-house col-6">
                <img src="{{ asset('img/homepage.jpg') }}" alt="">
            </div>
            <div class="text-house col-6">
                <h1>Apartment Title</h1>
                <small>Place, Address</small>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias debitis optio fuga eveniet aut quia omnis officiis est minima commodi non, dolorem consectetur incidunt, quo dolores magni qui illum aliquid?</p>
                <div class="sevices d-flex flex-column flex-wrap">
                    <span>Rooms</span>
                    <span>Beds</span>
                    <span>Bathrooms</span>
                    <span>m2</span>
                    <span>Wifi</span>
                    <span>Car Park</span>
                    <span>Reception</span>
                </div>
            </div>
        </div>
    </div>

@endsection
