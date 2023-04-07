<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta http-equiv="refresh" content="1"> --}}
    <title>Register | Agroperate</title>
    <link rel="stylesheet" href="{{ url('assets/cssBootstrap/bootstrap.min.css') }}">
</head>
<body class="bg-primary bg-opacity-25">
    @if ($errors->any())
        <div class="pt-3">
            <div class="alert alert-danger ">
                <ul>
                    @foreach ($errors->all() as $items)
                        <li>{{ $items }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
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
                            <form action="{{ url('beranda') }}" class="m-5" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label" for="nama_usaha">Nama Usaha</label>
                                        <input class="form-control" type="text" id="nama_usaha"  placeholder="Masukkan nama usaha" name="nama_usaha">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label" for="no_handphone">No Handphone</label>
                                        <input class="form-control" type="text" id="no_handphone"  placeholder="Masukkan no handphone" name="nomor_handphone">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label" for="alamat">Alamat</label>
                                        <input class="form-control" type="text" id="alamat"  placeholder="Masukkan alamat" name="alamat">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control" type="text" id="email"  placeholder="Masukkan email" name="email">
                                    </div>
                                    <div class="col-6">
                                        <div class="col-12">
                                            <label class="form-label" for="provinsi">Provinsi</label>
                                            <select class="form-control form-select form-select-sm" id="provinsi" name="provinsi">
                                                <option>Pilih Provinsi</option>
                                                @foreach ($provinsi as $item)
                                                    <option value="{{ $item->provinsi_id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="kabupaten">Kabupaten</label>
                                            <select class="form-control form-select form-select-sm" id="kabupaten" name="kabpuaten">
                                                <option>Pilih Kabupaten</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="kecamatan">Kecamatan</label>
                                            <select class="form-control form-select form-select-sm" id="kecamatan">
                                                <option>Pilih Kecamatan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="col-12 mt-4">
                                            <label class="form-label" for="username">Username</label>
                                            <input class="form-control" type="text" id="username"  placeholder="11 | " name="username">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="password">Password</label>
                                            <input class="form-control" type="password" id="password"  placeholder="Masukkan password" name="password">
                                        </div>
                                    </div>
                                        <div class="text-center">
                                        <button class="btn btn-primary form-control mt-4 w-50" type="submit">Registrasi</button>
                                    </div>
                                    <div class="text-center mt-4">
                                        <span>Sudah memiliki akun? <a href="{{ url('login') }}">Klik Di sini</a></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="//code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#provinsi').on('change', function() {
                var provinsi_id = $(this).val();
        if(provinsi_id) {
            $.ajax({
                url: '/register/kabupaten/'+provinsi_id,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#kabupaten').empty();
                    $('#kabupaten').append('<option value="">Pilih Kabupaten</option>');
                    $.each(data, function(key, value) {
                        $('#kabupaten').append('<option value="'+ value.kabupaten_id +'">'+ value.nama +'</option>');
                    });
                }
            });
        }else{
            $('#kabupaten').empty();
            $('#kabupaten').append('<option value="">Pilih Kabupaten</option>');
        }
            })
        })
    </script>
</body>
</html>