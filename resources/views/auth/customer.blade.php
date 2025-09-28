<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ohayo-Customer</title>
    <link rel="stylesheet" href="{{ asset('css/login.css?v6++') }}">
    <link rel="stylesheet" href="{{ asset('remixicon/fonts/remixicon.css') }}">
</head>

<body>
    <div class="container2">
        <div class="form">
            <div class="title">
                <h2 class="title-text">Selamat Datang Di Ohayoy</h2>
                <h3 class="title-text">Kamu berada di {{ Auth::guard('meja')->user()->nama_meja }}</h3>
                <p class="desc">Yuk, isi username dengan username pilihan kamu, <br>
                    username ini digunakan untuk pesanan kamu nanti </p>
            </div>
            <form action="{{ route('customer.username.valid') }}" method="POST">
                @csrf
                <div class="input">
                    <input type="text" name="username" id="" placeholder="Username : minimal 8 karakter" autocomplete="off"
                        minlength="8" maxlength="12">
                    <input type="submit" name="" id="" value="Masuk">
                </div>

            </form>
        </div>
    </div>
</body>

</html>
