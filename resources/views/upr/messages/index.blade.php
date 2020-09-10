@extends('layouts.app-upr')

@section('content')
    <div class="your-messages">
        <div class="container">
            <div class="title">
                <h1>Your-message</h1>
                <hr>
            </div>
            <div class="users-message">
                <div class="row">
                    <div class="messages col-lg-5">
                        <div class="message visible">
                            <h2 class="hidden">Apartment 1</h2>
                            <a href="#">utenteinteressato@gmail.com</a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <div class="time">
                                <span>18 giu 2020 - 18:30</span>
                            </div>
                    </div>
                    <div class="message">
                        <h2 class="hidden">Apartment 2</h2>
                        <a href="#">utenteinteressato-1@gmail.com</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <div class="time">
                            <span>20 mar 2020 - 15:45</span>
                        </div>
                    </div>
                    <div class="message">
                        <h2 class="hidden">Apartment 3</h2>
                        <a href="#">utenteinteressato-2@gmail.com</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <div class="time">
                            <span>28 feb 2020 - 11:00</span>
                        </div>
                    </div>
                    <div class="message">
                        <h2 class="hidden">Apartment 4</h2>
                        <a href="#">utenteinteressato-3@gmail.com</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <div class="time">
                            <span>17 set 2020 - 09:15</span>
                        </div>
                    </div>
                </div>
                <div class="description-message col-lg-7">
                    <div class="description active">
                        <div class="email-time">
                            <a href="#">utenteinteressato@gmail.com</a>
                            <span>18 giu 2020 - 18:30</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div class="description">
                        <div class="email-time">
                            <a href="#">utenteinteressato-1@gmail.com</a>
                            <span>20 mar 2020 - 15:45</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                    <div class="description">
                        <div class="email-time">
                            <a href="#">utenteinteressato-2@gmail.com</a>
                            <span>28 feb 2020 - 11:00</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div class="description">
                        <div class="email-time">
                                <a href="#">utenteinteressato-3@gmail.com</a>
                                <span>17 set 2020 - 09:15</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
