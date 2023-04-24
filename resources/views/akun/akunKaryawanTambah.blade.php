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
    <form action="{{ route('akunKaryawan.tambah.save') }}" method="POST">
        @csrf
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="p-3 py-5">
                        <div class="row mt-3">
                            <div class="col-md-12 mb-2"><label class="labels">Nama</label><input type="text" class="form-control bg-white" name="nama"></div>
                            <div class="col-md-12 mb-2"><label class="labels">Alamat</label><input type="text" class="form-control bg-white" name="alamat"></div>
                            <div class="col-md-12 mb-2">
                                <livewire:region />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 py-5 mt-5">
                        <div class="col-md-12 mb-2"><label class="labels">No Handphone</label><input type="text" class="form-control bg-white" name="nomor_handphone"></div>
                        <div class="col-md-12 mb-2"><label class="labels">Email</label><input type="text" class="form-control bg-white" name="email"></div>
                        <div class="col-md-12 mb-2"><label class="labels">Jabatan</label><input type="text" class="form-control bg-white" name="jabatan"></div>
                        <div class="col-md-12 mb-2"><label class="labels">Password</label><input type="text" class="form-control bg-white" name="password"></div>
                    </div>
                </div>
            </div>
            <div class="row text-center justify-content-end">
                <div class="mb-5 col-auto">
                    <button class="btn btn-primary profile-button" type="submit">Simpan</button>
                    <a href="{{ route('akunKaryawan') }}" class="btn btn-danger profile-button">Batal</a>
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


</body>
@endsection