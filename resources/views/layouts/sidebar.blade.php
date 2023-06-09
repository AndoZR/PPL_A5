<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('beranda.usaha') }}">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
            <img href='{{ asset('assets/src/LOGO.png') }}' width="100%" height="auto">
        </div>
        <div class="sidebar-brand-text mx-3">OPERATS</div>
    </a>
    
    {{-- fitur kelompok 1 --}}
    <div>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('produk') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Produk</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('pendapatan') }}">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Pendapatan</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('pengeluaran') }}">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Pengeluaran</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('keuangan') }}">
            <i class="fas fa-fw fa-cash-register"></i>
            <span>Keuangan</span></a>
    </li>
</div>
    

@if (Auth::guard('web')->check() && in_array(Auth::guard('web')->user()->status, ['sts2','sts3']))
<!-- Fitur Premium -->
<div>
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Premium
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ramalan') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Ramalan</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Rekomendasi</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- h6 class="collapse-header">Login Screens:</!-->
                <a class="collapse-item" href="{{ route('knapsack') }}">Knapsack</a>
                <a class="collapse-item" href="{{ route('dataKnapsack') }}">Data Knapsack</a>
            </div>
        </div>
    </li>
</div>
@endif
    
{{-- fitur kelompok 3 --}}
{{-- <div>
        <!-- Divider -->
        <hr class="sidebar-divider">
            
        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>
            
            <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Components</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a>
                </div>
            </div>
        </li>
    
    
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Utilities:</h6>
                    <a class="collapse-item" href="utilities-color.html">Colors</a>
                    <a class="collapse-item" href="utilities-border.html">Borders</a>
                    <a class="collapse-item" href="utilities-animation.html">Animations</a>
                    <a class="collapse-item" href="utilities-other.html">Other</a>
                </div>
            </div>
        </li>
</div> --}}
    
<!-- Divider -->
{{-- <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Rekomendasi</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- h6 class="collapse-header">Login Screens:</!-->
                <a class="collapse-item" href="login.html">Knapsack</a>
                <a class="collapse-item" href="register.html">Data Knapsack</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>
    @if (auth()->user()->status == 'premium')
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ramalan') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Ramalan</span></a>
    </li>
    @endif

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Produk</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> --}}

@if (Auth::guard('web')->check() && Auth::guard('web')->user()->status == 'sts1')
    <!-- Sidebar Message buat ke premium -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{ asset('img/undraw_rocket.svg') }}" alt="">
        <p class="text-center mb-2"><strong>OPERATS</strong> memiliki fitur premium, aktifkan sekarang!</p>
        <a class="btn btn-success btn-sm" href="#" onclick="redirectToPremium()">Get Premium!</a>
    </div> 
@endif

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>

<script>
    function redirectToPremium() {
       // Arahkan pengguna ke halaman tujuan
       window.location.href = "{{ route('berandaPricing') }}";
    }
</script>