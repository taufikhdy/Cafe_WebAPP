<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="scroll-restoration" content="manual"> --}}
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/customer.css?8++') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" href="{{ asset('remixicon/fonts/remixicon.css?v2++') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/other.css') }}"> --}}
</head>

<body>


    @include('components.sidebar')
    @include('components.customerBar')


    <div class="content">
        @yield('content')
    </div>


    {{-- JAVASCRIPT --}}
    <script src="{{ asset('js/javascript.js?v4++') }}"></script>
    <script src="{{ asset('js/chart.umd.min.js') }}"></script>
</body>

</html>
