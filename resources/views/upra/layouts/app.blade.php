<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page-title')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('partials.headers.menu')
    @yield('content')
    @include('partials.footer.footer')

<script src=" {{ asset('js/app.js')}}" charset="utf-8"></script>
</body>
</html>
