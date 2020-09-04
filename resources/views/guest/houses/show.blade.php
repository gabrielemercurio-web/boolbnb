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
            <div id="slider" class=" col-md-6">

                    <div class="prev">
                        <i class="fas fa-chevron-circle-left"></i>
                    </div>
                    <div class="next">
                        <i class="fas fa-chevron-circle-right"></i>
                    </div>

                    <div class="images">
                        <img class="visible" src="{{ asset('img/homepage.jpg') }}" alt="house">
                        <img class="" src="{{ asset('img/house-1.jpg') }}" alt="house">
                        <img class="" src="{{ asset('img/house-2.jpg') }}" alt="house">
                        <div class="bullets">
                            <i class="fas fa-circle visible"></i>
                            <i class="fas fa-circle"></i>
                            <i class="fas fa-circle"></i>
                        </div>
                    </div>

            </div>

            <div class="text-house col-md-6">
                <h1>Apartment Title {{-- $house->title --}} </h1>
                <small><i class="fas fa-map-marker-alt"></i>Place, Address</small>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias debitis optio fuga eveniet aut quia omnis officiis est minima commodi non, dolorem consectetur incidunt, quo dolores magni qui illum aliquid?</p>
                <div class="sevices d-flex flex-column flex-wrap">
                    <span><i class="fas fa-door-open"></i>Rooms</span>
                    <span><i class="fas fa-bed"></i>Beds</span>
                    <span><i class="fas fa-bath"></i>Bathrooms</span>
                    <span><i class="fas fa-border-style"></i>m2</span>
                    <span><i class="fas fa-wifi"></i>Wifi</span>
                    <span><i class="fas fa-parking"></i>Car Park</span>
                    <span><i class="fas fa-user-check"></i>Reception</span>
                </div>
            </div>
        </div>
    </div>

    <section id="map-contact">
        <div class="container">
            <div class="row row-3">

                <div id="contact" class="col-md-6">
                    <h1>Contact Owner</h1>
                    <form>
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Your email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Your message"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn">Send</button>
                        </div>
                    </form>
                </div>
                <div id="map" class="col-md-6">
                    <img src="https://www.worldeasyguides.com/wp-content/uploads/2013/01/Place-Vendome-on-Map-of-Paris.jpg" alt="Map">
                </div>

            </div>
        </div>
    </section>

@endsection
