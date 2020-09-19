{{-- pagina inserimento dati nuovo appartamento --}}
@extends('layouts.app-upr')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="d-flex align-items-center">
					<h1 class="mt-3 mb-3">New apartment</h1>
				</div>
				{{-- ERROR HANDLING --}}
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
						</ul>
					</div>
				@endif
				{{-- MAIN FORM --}}
				<form id="form-create" action="{{ route('upr.houses.store') }}" method="post" enctype="multipart/form-data">
					@csrf
                    <div class="form-group">
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                    </div>
					<div class="form-group">
						<label for="house-title">Title</label>
						<input type="text" name="title" class="form-control" id="house-title" placeholder="Title" value="{{ old('title') }}" required>
					</div>
					<div class="form-group">
						<label for="house-description">Description</label>
						<textarea type="text" name="description" class="form-control" id="house-description" placeholder="Description" required>{{ old('description') }}</textarea>
					</div>
					<div class="form-group">
						<label for="house-address" class="house-autosearch" value="{{ old('address')}}">Address</label>

					</div>
					<div class="form-group">
						<label for="image">Add image</label>
						<input type="file" name="cover_image" class="form-control-file" id="image" value="{{ old('cover_image') }}">
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
							<label for="house-nr_of_bathrooms">Bathrooms</label>
							<input type="number" name="nr_of_bathrooms" class="form-control" id="house-nr_of_bathrooms" placeholder="Bathroom" value="{{ old('nr_of_bathrooms') }}">
						</div>
						<div class="form-group">
							<label for="house-square_mt">Square meters</label>
							<input type="text" name="square_mt" class="form-control" id="house-square_mt" placeholder="m2" value="{{ old('square_mt') }}">
                        </div>

                    </div>

					{{-- SERVICES --}}
					<label for="house-services">Features:</label>
					<div class="form-check form-check-inline d-flex justify-content-around">
						@foreach ($services as $service)
							<label class="form-check-label" for="house-service">{{ ucfirst($service->name) }}</label>
							<input class="form-check-input" type="checkbox" id="house-services" name="{{'services_ids[]'}}" value="{{ $service->id }}" {{in_array($service->id, old('services_ids', [])) ? 'checked' : ''}}>

						@endforeach
					</div>

                    {{-- Hidden values for storing address-related values --}}
                    <div class="form-group">
						<input type="text" name="latitude" value="{{ old('latitude') }}" hidden>
						<input type="text" name="longitude" value="{{ old('longitude') }}" hidden>
						<input type="text" name="address" value="{{ old('address') }}" hidden>
                    </div>
                	<div>
						<button type="submit" id="btnUpload" class="btn btn-primary">Add home</button>
					</div>
				</form>
			</div>

		</div>
	</div>

@endsection
