<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="scroll-restoration" content="manual"> --}}
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/main.css?V5++') }}">
    <link rel="stylesheet" href="{{ asset('css/other.css') }}">
</head>

<body>


    @include('components.navbar')
    <div class="flex">
        @include('components.sidebar')

        <div class="content">
            @yield('content')
        </div>

    </div>

</body>

</html>
