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

<body>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Halo</h4>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mb-2"><label class="labels">Nama Usaha</label><input disabled type="text" class="form-control bg-white" value=""></div>
                        <div class="col-md-12 mb-2"><label class="labels">Alamat</label><input disabled type="text" class="form-control bg-white" value=""></div>
                        <div class="col-md-12 mb-2"><label class="labels">Kecamatan</label></label><input disabled type="text" class="form-control bg-white" value=""></div>
                        <div class="col-md-12 mb-2"><label class="labels">Kabupaten</label><input disabled type="text" class="form-control bg-white" value=""></div>
                        <div class="col-md-12 mb-2"><label class="labels">Provinsi</label><input disabled type="text" class="form-control bg-white" value=""></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 py-5 mt-5">
                    <div class="col-md-12 mb-2"><label class="labels">No Handphone</label><input disabled type="text" class="form-control bg-white" value=""></div>
                    <div class="col-md-12 mb-2"><label class="labels">Email</label><input disabled type="text" class="form-control bg-white" value=""></div>
                    <div class="col-md-12 mb-2"><label class="labels">Username</label><input disabled type="text" class="form-control bg-white" value=""></div>
                    <div class="col-md-12 mb-2"><label class="labels">Password</label><input disabled type="text" class="form-control bg-white" value=""></div>
                </div>
            </div>

        </div>
        <div class="row text-center justify-content-end">
            <div class="mb-5 col-auto">
                <a href="{{ route('akunUsaha.edit') }}" class="btn btn-primary profile-button" type="button">Edit Akun</a>
            </div>
        </div>
    </div>
@if (session('message')))
    <script>
        Swal.fire(
        'Whoops',
           `{{ session('message') }}`,
        'success'
    )
    </script>    
@endif   
</body>
@endsection