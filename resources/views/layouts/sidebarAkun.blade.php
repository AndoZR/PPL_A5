<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('beranda') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">OPERATS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    {{-- <li class="nav-item mt-3 mb-4 ml-4 mr-4">
        <img class="img-profile rounded-circle"
        src="{{ asset('img/undraw_profile.svg') }}">
    </li> --}}

    {{-- <li class="nav-item">
        <span>{{ auth()->user()->nama_usaha }}</span>
    </li> --}}

    <!-- Nav Item  -->
    @if (Auth::guard('web')->check())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('akunUsaha') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Akun Usaha</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('akunKaryawan') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Akun Karyawan</span></a>
        </li>
        @elseif (Auth::guard('karyawan')->check())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('akunUsaha') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Akun Usaha</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('akunKaryawan.detail', Auth::guard('karyawan')->user()->username) }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Akun Karyawan</span></a>
            </li>
            @endif
    <a href="{{ route('dashboard') }}" class="ml-3 mr-3 d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">Kembali ke Dashboard</a>        
</ul>