<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda | Agroperate</title>
    <link rel="stylesheet" href="{{ url('assets/cssBootstrap/bootstrap.min.css') }}">
</head>
<body>
    <div>
        <form action='{{ url('login') }}'>
            <button class="btn btn-primary">Login</button>
        </form>
    </div>
    <div>
        <form action='{{ url('register') }}'>
            <button class="btn btn-primary">Register</button>
        </form>
    </div>
    tesberana
</body>
</html>