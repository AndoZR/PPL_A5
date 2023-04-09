<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta http-equiv="refresh" content="1"> --}}
    <title>Register | Agroperate</title>
    <link rel="stylesheet" href="{{ url('assets/cssBootstrap/bootstrap.min.css') }}">
    @livewireStyles
</head>
<body class="bg-primary bg-opacity-25">
    <section class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div class="container mb-5 mt-5">
            <div class="row">
                <div class="col-md-10 mx-auto rounded bg-white">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{ url('assets/src/login.svg') }}" alt="login" class="img-fluid p-2 mt-5">
                        </div>
                        <div class="col-md-7">
                            <div class="m-5 text-center">
                                <h2>Registrasi Akun Usaha</h2>
                                <h6>Silahkan membuat akun usaha Anda</h6>
                            </div>
                            <form action="{{ route('register.simpan') }}" class="m-5 mb-2" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label" for="nama_usaha">Nama Usaha</label>
                                        <input class="form-control @error('nama_usaha')is-invalid @enderror" type="text" id="nama_usaha"  placeholder="Masukkan nama usaha" name="nama_usaha">
                                        @error('nama_usaha')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label" for="no_handphone">No Handphone</label>
                                        <input class="form-control @error('nomor_handphone')is-invalid @enderror" type="text" id="no_handphone"  placeholder="Masukkan no handphone" name="nomor_handphone">
                                        @error('nomor_handphone')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="alamat">Alamat</label>
                                            <input class="form-control @error('alamat')is-invalid @enderror" type="text" id="alamat"  placeholder="Masukkan alamat" name="alamat">
                                            @error('alamat')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <input class="form-control @error('password')is-invalid @enderror" type="password" id="password"  placeholder="Masukkan password" name="password">
                                            @error('password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input class="form-control @error('email')is-invalid @enderror" type="text" id="email"  placeholder="Masukkan email" name="email">
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <livewire:region />
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary form-control mt-4 w-50" type="submit">Registrasi</button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-center mt-0 mb-4">
                                <span>Sudah memiliki akun? <a href="{{ route('login') }}">Klik Di sini</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @livewireScripts
</body>
</html>