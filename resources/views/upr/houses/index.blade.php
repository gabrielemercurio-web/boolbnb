{{-- pagina lista appartamenti gestiti dall'utente --}}
@extends('layouts.app-upr')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 my-home-title">
                <h1>MY HOMES</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            @foreach ($houses as $house)
                <div class="card-upr col-md-6">
                    <img src="{{ $house->image_path }}" alt="house">
                    <div>
                        <a href="{{ route('upr.houses.show', ['house' => $house->id]) }}">
                            <h1>{{ $house->title }}</h1>
                        </a>
                        <div class="button-my-homes">
                            <a href="{{ route('upr.houses.edit', ['house'=>$house->id]) }}" class="btn-blue">UPDATE</a>
                            {{-- <a href="{{ route('upr.houses.index', ['house'=>$house->id]) }}" onclick="return confirm(' Do you want to delete?');" class="btn-blue">DELETE</a> --}}
                            <form class="d-inline" action="{{ route('upr.houses.destroy', ['house' => $house->id]) }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                <input type="submit" class="btn btn-small btn-info delete "value="Delete">
                            </form>
                            <a href="{{ route('upr.payments.create') }}" class="btn-white">PROMOTE</a>
                            <a class="btn-white">STATS</a>
                            @if($house->visible == true)
                                <a href="{{ route('upr.houses.update', ['house' => $house->id]) }}" class="btn-white">HIDE HOME</a>
                            @else
                                <a href="{{ route('upr.houses.update', ['house' => $house->id]) }}" class="btn-white">SHOW HOME</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <a href="{{ route('upr.houses.create') }}" class="create-house col-md-6">
                <div> <i class="fas fa-plus"></i> </div>
            </a>
        </div>
    </div>
@endsection
