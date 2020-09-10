@extends('layouts.app-upr')

@section('content')
    <div class="sponsor-wrapper">
        <div class="container">
            <div class="sponsor-title">
                <h1>Sponsor Apartment 1</h1>
                <hr>
            </div>
            <div class="sponsor-plane text-center">
                <p>1 - Scegli il piano di sponsorizzazione</p>
                <div class="sponsor-price">
                    <div class="price active">
                        <button>2,99€ per 24 ore di sponsorizzazione</button>
                    </div>
                    <div class="price second">
                        <button>5,99€ per 72 ore di sponsorizzazione</button>
                    </div>
                    <div class="price third">
                        <button>9,99€ per 144 ore di sponsorizzazione</button>
                    </div>
                </div>

            </div>
            <div class="information-payments text-center">
                <p>2 - Inserisci i tuoi dati di pagamento</p>
                <form>
                <div class="form-group number-cc">
                    <input type="email" class="form-control" id="number-cc" aria-describedby="emailHelp" placeholder="Numero CC *">
                </div>
                <div class="form-group date-and-cvc">
                    <input type="password" class="form-control" id="date" placeholder="Data di scadenza">
                    <input type="password" class="form-control" id="cvc" placeholder="CVC">
                </div>
                    <button type="submit" class= "btn-payments">Paga ora</button>

                </form>
            </div>
        </div>
    </div>
@endsection
