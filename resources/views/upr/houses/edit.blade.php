{{-- pagina modifica dati appartamento --}}
@extends('layouts.app-upr')

@section('content')
	<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <h1 class="mt-3 mb-3">Edit Apartment</h1>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('upr.houses.update', ['house' => $house->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- old si usa per la validazione, senza old nel value scrivere value = $movie->title --}}
                    <div class="form-group">
                        <label for="house-title">Title</label>
                        <input type="text" name="title" class="form-control" id="house-title" placeholder="Title" value="{{ old('title', $house->title) }}">
                    </div>
                    <div class="form-group">
                        <label for="house-description">Description</label>
                        <textarea type="text" name="description" class="form-control" id="house-description" placeholder="Description">{{ old('description', $house->description)}}</textarea>
                    </div>
                    <div class="form-group">
						<label for="house-address">Address</label>
						<input type="text" name="address" class="form-control" id="house-address" placeholder="Address" value="{{ old('address', $house->address) }}">
                    </div>
					<div class="form-group">
						<label for="image">Insert image</label>
						<input type="file" name="image" class="form-control-file">
						<p>Copertina attuale</p>
                        <img src="{{ asset('storage/' . $house->image_path) }}" class="img-thumbnail" alt="">
					</div>
					<div class="form-group d-flex justify-content-between">
						<div class="form-group">
							<label for="house-nr_of_rooms">Rooms</label>
							<input type="number" name="nr_of_rooms" class="form-control" id="house-nr_of_rooms" placeholder="Rooms" value="{{ old('nr_of_rooms', $house->nr_of_rooms) }}">
						</div>
						<div class="form-group">
							<label for="house-nr_of_beds">Beds</label>
							<input type="number" name="nr_of_beds" class="form-control" id="house-nr_of_beds" placeholder="Beds" value="{{ old('nr_of_beds', $house->nr_of_beds) }}">
						</div>
						<div class="form-group">
							<label for="house-nr_of_bathrooms">Bathroom</label>
							<input type="number" name="nr_of_bathrooms" class="form-control" id="house-nr_of_bathrooms" placeholder="Bathroom" value="{{ old('nr_of_bathrooms', $house->nr_of_bathrooms) }}">
						</div>
						<div class="form-group">
							<label for="house-square_mt">Metri quadrati</label>
							<input type="text" name="square_mt" class="form-control" id="house-square_mt" placeholder="m2" value="{{ old('square_mt', $house->square_mt) }}">
						</div>
					</div>
                    <div>
                        <button type="submit" class="btn btn-primary">Save Apartment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
