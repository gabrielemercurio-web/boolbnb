@extends('layouts.app-upr')

@section('content')
    <div class="your-messages">
        <div class="container">
            <div class="title">
                <h1>Your messages</h1>
                <hr>
            </div>
            <div class="users-message">
                <div class="row col-lg-12">
                    <div class="messages col-lg-5">
                        @forelse ($messages as $message)
                            <div class="message @if ($loop->first) visible @endif">
                                <h2 class="hidden">Apartment {{ $message->house_id }}</h2>
                                <a href="mailto:{{ $message->sender_email }}">{{ $message->sender_email }}</a>
                                <p class="transition">{{ $message->message }} </p>
                                <div class="time">
                                    <span>{!! htmlspecialchars_decode(date('j<\s\up>S</\s\up> F Y h:i A', strtotime($message->created_at))) !!}</span>
                                </div>
                            </div>
                        @empty
                            <p>There are no messages available in the inbox.</p>
                        @endforelse
                    </div>

                <div class="description-message col-lg-7">
                    @foreach ($messages as $message)
                        <div class="description @if ($loop->first) active @endif">
                            <div class="email-time">
                                <a href="mailto:{{ $message->sender_email }}">{{ $message->sender_email }}</a>
                                <span>{!! htmlspecialchars_decode(date('j<\s\up>S</\s\up> F Y h:i A', strtotime($message->created_at))) !!}</span>
                            </div>
                            <p>{{ $message->message }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
