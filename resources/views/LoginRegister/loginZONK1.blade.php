<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Agroperate</title>
    <link rel="stylesheet" href="{{ url('assets/cssBootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/styleLogin.css') }}">
</head>
<body>
    @csrf
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                    <!-------Image-------->
                    <div class="text">
                        {{-- <p>Join the community of developers <i>- ludiflex</i></p> --}}
                    </div>
                </div>
                <div class="col-md-6 right">
                     <div class="input-box">
                        <header>Selamat Datang <br> Kembali</header>
                        <div class="input-field">
                            <input type="text" class="input" id="email" required autocomplete="off">
                            <label for="email">Username</label>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input" id="password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="submit" value="Sign In">
                            
                        </div>
                        <div class="signin">
                            <span>Belum memiliki akun? <a href="{{ url('register') }}">Klik di sini</a></span>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>