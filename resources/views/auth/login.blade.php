<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta http-equiv="refresh" content="1"> --}}
    <title>Login | Agroperate</title>
    <link rel="stylesheet" href="{{ url('assets/cssBootstrap/bootstrap.min.css') }}">
</head>
<body class="bg-primary bg-opacity-25">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <section class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto rounded bg-white">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ url('assets/src/login.svg') }}" alt="login" class="img-fluid p-2 mt-5">
                        </div>
                        <div class="col-md-6">
                            <div class="m-5 text-center">
                                <h2>Selamat Datang</h2>
                            </div>
                            <form action="{{ route('login.akses') }}" class="m-5" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="username">Username</label>
                                        <input class="form-control" type="text" id="username" placeholder="Masukkan username anda" name="username">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input class="form-control" type="password" id="password" placeholder="Masukkan password anda" name="password">
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary form-control mt-3 w-50" type="submit">Login</button>
                                    </div>
                                    <div class="text-center mt-4">
                                        <span>Belum memiliki akun? <a href="{{ route('register') }}">Klik Di sini</a></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>