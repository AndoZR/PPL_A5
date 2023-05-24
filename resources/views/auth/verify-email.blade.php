<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta http-equiv="refresh" content="1"> --}}
    <title>Verifikasi | OPERATS</title>
    <link rel="stylesheet" href="{{ url('assets/cssBootstrap/bootstrap.min.css') }}">
    <script src="{{ asset("assets/sweetalert2/dist/sweetalert2.all.min.js") }}"></script>
</head>
<body class="bg-primary bg-opacity-25">
    <section class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto rounded bg-white">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ url('assets/src/login.svg') }}" alt="login" class="img-fluid p-2 m-5">
                        </div>
                        <div class="col-md-6">
                            <div class="m-5 mt-2">
                                @csrf
                                <div class="text-center mt-5">
                                    <h3>Kami telah mengirimkan verifikasi pada email Anda, silahkan cek email Anda sekarang!</h3>
                                    {{-- <button class="btn btn-primary form-control mt-3 w-50" type="submit">Login</button> --}}
                                </div>
                                <div class="text-center mt-4">
                                    <span>Belum mendapatkan pesan email? <a href="{{ route('register.simpan') }}">Klik Di sini</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@if ($errors->all())
    <script>
        Swal.fire(
        'Whoops',
           `@foreach ($errors->all() as $items)
            {{ $items }}
            <?php break ?>
            @endforeach`,
        'error'
    )
    </script>    
@endif
</body>
</html>