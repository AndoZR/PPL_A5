<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ganti Password</title>
    <link rel="stylesheet" href="{{ url('assets/cssBootstrap/bootstrap.min.css') }}">
    <script src="{{ asset("assets/sweetalert2/dist/sweetalert2.all.min.js") }}"></script>
</head>
<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('status'))
        <div class="alert alert-success">
            {{ session()->get('status') }}
        </div>
    @endif
    <div class="container">
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="token" value="{{ request()->token }}">
                <input type="hidden" name="email" value="{{ request()->email }}">
                <label class="form-label" for="newPassword">Password Baru</label>
                <input class="form-control" type="password" name="password">
            </div>
            <div class="mb-3">
                <label class="form-label" for="repeatPassword">Ulangi Password</label>
                <input class="form-control" type="password" name="password_confirmation">
            </div>
            <div>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>    
</body>
</html>