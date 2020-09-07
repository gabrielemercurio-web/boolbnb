{{-- pagina inserimento dati nuovo appartamento --}}
@extends('layouts.app-upr')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="d-flex align-items-center">
					<h1 class="mt-3 mb-3">New apartament </h1>
				</div>
				<form action="{{ route('upr.houses.store') }}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label for="house-title">Title</label>
						<input type="text" name="title" class="form-control" id="house-title" placeholder="Title" value="{{ old('title') }}">
					</div>
					<div class="form-group">
						<label for="house-description">Description</label>
						<textarea type="text" name="description" class="form-control" id="house-description" placeholder="Description">{{ old('description') }}</textarea>
					</div>
					<div class="form-group">
						<label for="house-address">Address</label>
						<input type="text" name="address" class="form-control" id="house-address" placeholder="Address" value="{{ old('address') }}">
					</div>
					<div class="form-group">
						<label for="image">Insert image</label>
						<input type="file" name="image" class="form-control-file">
					</div>
					<div class="form-group d-flex justify-content-between">
						<div class="form-group">
							<label for="house-nr_of_rooms">Rooms</label>
							<input type="number" name="nr_of_rooms" class="form-control" id="house-nr_of_rooms" placeholder="Rooms" value="{{ old('nr_of_rooms') }}">
						</div>
						<div class="form-group">
							<label for="house-nr_of_beds">Beds</label>
							<input type="number" name="nr_of_beds" class="form-control" id="house-nr_of_beds" placeholder="Beds" value="{{ old('nr_of_beds') }}">
						</div>
						<div class="form-group">
							<label for="house-nr_of_bathrooms">Bathroom</label>
							<input type="number" name="nr_of_bathrooms" class="form-control" id="house-nr_of_bathrooms" placeholder="Bathroom" value="{{ old('nr_of_bathrooms') }}">
						</div>
						<div class="form-group">
							<label for="house-square_mt">Metri quadrati</label>
							<input type="text" name="square_mt" class="form-control" id="house-square_mt" placeholder="m2" value="{{ old('square_mt') }}">
						</div>
					</div>
					<div>
						<a href="{{ route('upr.houses.index') }}"><button type="submit" class="btn btn-primary">Upload Apartment</button></a>
					</div>
				</form>
			</div>

		</div>
	</div>
@endsection
