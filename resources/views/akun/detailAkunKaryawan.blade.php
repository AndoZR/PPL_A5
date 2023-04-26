@extends('layouts.app')

@section('title', 'Akun Karyawan')

@section('content')
{{-- <style>
    body {
    background: rgb(99, 39, 120)
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
</style> --}}
@livewireStyles
<body>
    <form action="" method="POST">
        @csrf
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="col-md-12 mb-2"><label class="labels">Nama</label><input type="text" class="form-control bg-white" value="{{ $karyawan->nama }}" disabled name="nama"></div>
                    <div class="col-md-12 mb-2"><label class="labels">Alamat</label><input type="text" class="form-control bg-white" value="{{ $karyawan->alamat }}" disabled name="alamat"></div>
                    <div class="col-md-12 mb-2"><label class="labels">Provinsi</label><input type="text" class="form-control bg-white" value="{{ $provinsi->nama }}" disabled name="alamat"></div>
                    <div class="col-md-12 mb-2"><label class="labels">Kabupaten</label><input type="text" class="form-control bg-white" value="{{ $kabupaten->nama }}" disabled name="alamat"></div>
                    <div class="col-md-12 mb-2"><label class="labels">Kecamatan</label><input type="text" class="form-control bg-white" value="{{ $kecamatan->nama }}" disabled name="alamat"></div>
                </div>
                <div class="col-md-6 mt-3 mb-3">
                    <div class="col-md-12 mb-2"><label class="labels">No Handphone</label><input type="text" class="form-control bg-white" value="{{ $karyawan->nomor_handphone }}" disabled name="nomor_handphone"></div>
                    <div class="col-md-12 mb-2"><label class="labels">Email</label><input type="text" class="form-control bg-white" value="{{ $karyawan->email }}" disabled name="email"></div>
                    <div class="col-md-12 mb-2"><label class="labels">Jabatan</label><input type="text" class="form-control bg-white" value="{{ $karyawan->jabatan }}" disabled name="jabatan"></div>
                    <div class="col-md-12 mb-2"><label class="labels">Username</label><input type="text" class="form-control bg-white" value="{{ $karyawan->username }}" disabled name="username"></div>
                    <div class="col-md-12 mb-2"><label class="labels">Password</label><input type="text" class="form-control bg-white" value="{{ $karyawan->password }}" disabled name="password"></div>
                </div>

            </div>
            <div class="row text-center justify-content-end">
                <div class="mb-5 col-auto">
                    @if (Auth::guard('web')->check())
                    <a href="{{ route('akunKaryawan.hapus',$karyawan->username) }}" class="btn btn-danger profile-button" type="submit" id="sweetDelete">Hapus Akun</a>
                    <a href="{{ route('akunKaryawan') }}" class="btn btn-primary profile-button">Kembali</a>
                    @elseif (Auth::guard('karyawan')->check())
                    <a href="{{ route('akunKaryawan.edit', $karyawan->username) }}" class="btn btn-primary profile-button">Edit</a>
                    @endif
                </div>
            </div>
        </div>
    </form>
    @livewireScripts   
    
@if ($errors->any())
    @foreach ($errors->all() as $error)
        @if (strpos($error, 'required') !== false)
            <script>
                Swal.fire(
                    'Whoops',
                    'Terdapat kolom yang tidak diisi',
                    'error'
                )
            </script>
        @else
            <script>
                Swal.fire(
                    'Whoops',
                    'Tipe data yang dimasukkan salah',
                    'error'
                )
            </script>
        @endif
    @endforeach
@endif

@if (session('message'))
    <script>
        Swal.fire(
        'Sukses',
           `{{ session('message') }}`,
        'success'
    )
    </script>    
@endif 

</body>
@endsection