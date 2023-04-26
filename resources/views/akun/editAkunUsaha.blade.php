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
@livewireStyles
<body>
    <form action="{{ route('akunUsaha.edit.process') }}" method="POST">
        @csrf
        {{-- @if ($errors->any())
        <div class="pt-1">
            <div class="alert alert-danger alert-dismissible fade show d-flex">
                <button type="button" class="close" data-dismiss='alert' aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="mb-0">
                    @foreach ($errors->all() as $items)
                    <li>{{ $items }}</li>
                    @endforeach
                </ul>

            </div>
        </div>
         @endif --}}
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                {{-- <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
                </div> --}}
                <div class="col-md-6">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Halo {{ auth()->user()->nama_usaha }}</h4>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 mb-2"><label class="labels">Nama Usaha</label><input type="text" class="form-control bg-white" value="{{ $user->nama_usaha }}" name="nama_usaha"></div>
                            <div class="col-md-12 mb-2"><label class="labels">Alamat</label><input type="text" class="form-control bg-white" value="{{ $user->alamat }}" name="alamat"></div>
                            <div class="col-md-12 mb-2">
                                <livewire:region />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 py-5 mt-5">
                        <div class="col-md-12 mb-2"><label class="labels">No Handphone</label><input type="text" class="form-control bg-white" value="{{ $user->nomor_handphone }}" name="nomor_handphone"></div>
                        <div class="col-md-12 mb-2"><label class="labels">Email</label><input type="text" class="form-control bg-white" value="{{ $user->email }}" name="email"></div>
                        <div class="col-md-12 mb-2"><label class="labels">Password</label><input type="text" class="form-control bg-white" value="{{ $user->password }}" name="password"></div>
                    </div>
                </div>

            </div>
            <div class="row text-center justify-content-end">
                <div class="mb-5 col-auto">
                    <button class="btn btn-primary profile-button" type="submit">Simpan</button>
                    <a href="{{ route('akunUsaha') }}" class="btn btn-danger profile-button">Batal</a>
                </div>
            </div>
        </div>
    </form>
    @livewireScripts   
@if ($errors->any())
    @foreach ($errors->all() as $error)
        @if (strpos($error, 'required') !== false)
            <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Terdapat kolom yang belum diisi!',
            showConfirmButton: false,
            timer: 5000
        })
            </script>
        @else
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Tipe data yang dimasukkan salah!',
                    showConfirmButton: false,
                    timer: 5000
                })
            </script>
        @endif
    @endforeach
@endif


</body>
@endsection