<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <title>Ohayo-Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('remixicon/fonts/remixicon.css') }}">
</head>

<body>
    @guest

        <div class="container">
            <img src="{{ asset('images/banner.jpeg') }}" alt="" class="object-fit">

            <div class="form position toTop">


                <form action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    <div class="input">
                        <div class="">
                            <div class="text-small">Selamat datang di</div>
                            <h1>Ohayoy
                            Cafe Management System</h1>
                            <div class="text-small">Masuk untuk mengelola pesanan, stok, hingga laporan bisnis anda</div>
                        </div>
                        <br>
                        <input type="text" name="name" placeholder="Username" autocomplete="off">
                        @if (session('name'))
                            <p>{{ session('name') }}</p>
                        @endif
                        <div class="password">
                            <input type="password" name="password" id="password" placeholder="Password" autocomplete="off">
                            <label class="show" id="show" for="password" onclick="showPassword()">
                                <i class="ri-eye-off-line" id="eye"></i>
                            </label>
                        </div>
                        @if (session('password'))
                            <p>{{ session('password') }}</p>
                        @endif
                        <input type="submit" name="" value="Login">
                    </div>
                </form>
            </div>
        </div>

    @endguest

    <script src="{{ asset('js/javascript.js') }}"></script>
</body>

</html>
