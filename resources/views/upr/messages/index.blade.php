@extends('layouts.app-upr')

@section('content')
    <div class="your-messages">
        <div class="container">
            <div class="title">
                <h1>Your-message</h1>
                <hr>
            </div>
            <div class="users-message">
                <div class="messages col-5">
                    <div class="message visible">
                        <a href="#">utenteinteressato@gmail.com</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <div class="time">
                            <span>18 giugno 2020</span>
                        </div>
                    </div>
                    <div class="message">
                        <a href="#">utenteinteressato-1@gmail.com</a>
                        <p>Ciao a tutti</p>
                        <div class="time">
                            <span>18 giugno 2020</span>
                        </div>
                    </div>
                    <div class="message">
                        <a href="#">utenteinteressato-2@gmail.com</a>
                        <p>Ciao sono io</p>
                        <div class="time">
                            <span>18 giugno 2020</span>
                        </div>
                    </div>
                    <div class="message">
                        <a href="#">utenteinteressato-3@gmail.com</a>
                        <p>Ciao a tutti ma proprio tutti</p>
                        <div class="time">
                            <span>18 giugno 2020</span>
                        </div>
                    </div>
                </div>
                <div class="description-message col-7">
                    <div class="description active">
                        <div class="email-time">
                            <a href="#">utenteinteressato@gmail.com</a>
                            <span>29 ago 2020 - 18:30</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div class="description">
                        <div class="email-time">
                            <a href="#">utenteinteressato-1@gmail.com</a>
                            <span>29 ago 2020 - 18:30</span>
                        </div>
                        <p>Ciao a tutti</p>
                    </div>

                    <div class="description">
                        <div class="email-time">
                            <a href="#">utenteinteressato-2@gmail.com</a>
                            <span>29 ago 2020 - 18:30</span>
                        </div>
                        <p>Ciao sono io</p>
                    </div>
                    <div class="description">
                        <div class="email-time">
                                <a href="#">utenteinteressato-3@gmail.com</a>
                                <span>29 ago 2020 - 18:30</span>
                        </div>
                        <p>Ciao a tutti ma proprio tutti</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
