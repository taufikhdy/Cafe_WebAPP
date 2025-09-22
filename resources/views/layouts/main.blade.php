<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="scroll-restoration" content="manual"> --}}
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/main.css?v11++') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" href="{{ asset('remixicon/fonts/remixicon.css?v2++' )}}">
    {{-- <link rel="stylesheet" href="{{ asset('css/other.css') }}"> --}}
</head>

<body>


    @include('components.navbar')


    <section class="flex">
        @include('components.sidebar')
        @yield('content')
    </section>

    </div>

    {{-- JAVASCRIPT --}}
    <script src="{{asset('js/javascript.js?v3++')}}"></script>
    <script src="{{asset('js/chart.umd.min.js')}}"></script>
</body>

</html>
