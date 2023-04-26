@extends('layouts.app')

@section('title', 'Akun Usaha')

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
            {{-- <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
            </div> --}}
            <div class="col-md-6">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        @if (Auth::guard('web')->check())
                            <h4 class="text-right">Halo {{ Auth::guard('web')->user()->nama_usaha }}</h4>
                        @endif
                        </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mb-2"><label class="labels">Nama Usaha</label><input disabled type="text" class="form-control bg-white" value="{{ $user->nama_usaha }}"></div>
                        <div class="col-md-12 mb-2"><label class="labels">Alamat</label><input disabled type="text" class="form-control bg-white" value="{{ $user->alamat }}"></div>
                        <div class="col-md-12 mb-2"><label class="labels">Kecamatan</label></label><input disabled type="text" class="form-control bg-white" value="{{ $kecamatan->nama }}"></div>
                        <div class="col-md-12 mb-2"><label class="labels">Kabupaten</label><input disabled type="text" class="form-control bg-white" value="{{ $kabupaten->nama }}"></div>
                        <div class="col-md-12 mb-2"><label class="labels">Provinsi</label><input disabled type="text" class="form-control bg-white" value="{{ $provinsi->nama }}"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 py-5 mt-5">
                    <div class="col-md-12 mb-2"><label class="labels">No Handphone</label><input disabled type="text" class="form-control bg-white" value="{{ $user->nomor_handphone }}"></div>
                    <div class="col-md-12 mb-2"><label class="labels">Email</label><input disabled type="text" class="form-control bg-white" value="{{ $user->email }}"></div>
                    <div class="col-md-12 mb-2"><label class="labels">Username</label><input disabled type="text" class="form-control bg-white" value="{{ $user->username }}"></div>
                    <div class="col-md-12 mb-2"><label class="labels">Password</label><input disabled type="text" class="form-control bg-white" value="{{ $user->password }}"></div>
                </div>
            </div>

        </div>
        <div class="row text-center justify-content-end">
            @if (Auth::guard('web')->check())
            <div class="mb-5 col-auto">
                <a href="{{ route('akunUsaha.edit') }}" class="btn btn-primary profile-button" type="button">Edit Akun</a>
            </div>
            @endif
        </div>
    </div>
@if (session('message')))
    <script>
        Swal.fire(
        'Sukses!',
           `{{ session('message') }}`,
        'success'
    )
    </script>    
@endif   
</body>
@endsection