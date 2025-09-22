<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ohayo-Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css?v5++') }}">
    <link rel="stylesheet" href="{{ asset('remixicon/fonts/remixicon.css') }}">
</head>

<body>
    @guest

        <div class="container">
            <div class="title">
                <div class="text">
                    <h1>Ohayoy! <br> let's Login</h1>

                    <br>

                    <p>Welcome to ohayoy login page, lets login for manage your cafe now!</p>
                </div>
            </div>

            <div class="form">
                <form action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    <div class="input">
                        <input type="text" name="name" id="" placeholder="Username" autocomplete="off">
                        @if (session('name'))
                            <p>{{ session('name') }}</p>
                        @endif
                        <div class="password">
                            <input type="password" name="password" id="password" placeholder="Password">
                            <label class="show" id="show" for="password" onclick="showPassword()">
                                <i class="ri-eye-off-line" id="eye"></i>
                            </label>
                        </div>
                        @if (session('password'))
                            <p>{{ session('password') }}</p>
                        @endif
                        <input type="submit" name="" id="" value="Login">
                    </div>
                </form>
            </div>
        </div>
    @endguest

    <script src="{{ asset('js/javascript.js') }}"></script>
</body>

</html>
