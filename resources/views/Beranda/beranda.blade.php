<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

  <title>Beranda | OPERATS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- MIDTRANS CONFIG DISINI ~~~~ -->
  <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
  <script type="text/javascript"
  src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key='{{ config('midtrans.client_key') }}'></script>
  <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
  <!-- MIDTRANS CONFIG DISINI ~~~~ -->

  <!-- Favicons -->
  <link href="{{ asset('assetsBeranda/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assetsBeranda/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assetsBeranda/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsBeranda/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsBeranda/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsBeranda/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsBeranda/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsBeranda/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsBeranda/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assetsBeranda/css/style.css') }}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top shadow-lg">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="">OPERATS</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      {{-- <a href="index.html" class="logo me-auto"><img src="{{ asset('assetsBeranda/img/unej.png') }}" alt="" class="img-fluid"></a> --}}

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>

          {{-- <li class="dropdown"><a href="#"><span>Fitur</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{ route('produk') }}">Produk</a></li>
              <li><a href="{{ route('pendapatan') }}">Pendapatan</a></li>
              <li><a href="{{ route('keuangan') }}">Keuangan</a></li>
              @if (Auth::guard('web')->check() && Auth::guard('web')->user()->status === 'premium' )
              <li><a href="{{ route('ramalan') }}">Ramalan</a></li>
              <li><a href="{{ route('knapsack') }}">Knapsack</a></li>
              @endif
            </li>
          </ul> --}}
          @if (Auth::guard('web')->check() || Auth::guard('karyawan')->check())
            <!-- notif -->
            <li class="dropdown">
              <a style="color: white"><i class="bi bi-bell"></i></a>
              <ul style="max-width:500px; max-height:300px; overflow-y: auto;">
                @if(isset($collectnotif))
                  @foreach ($collectnotif as $item)
                    <li><a href="#">{{ $item }}</a></li>  
                  @endforeach
                @endif
              </ul>
            </li>
            <li><a href="{{ route('produk') }}">Produk</a></li>
            <li><a href="{{ route('pendapatan') }}">Pendapatan</a></li>
            <li><a href="{{ route('keuangan') }}">Keuangan</a></li>
          @endif

          @if (Auth::guard('web')->check() && in_array(Auth::guard('web')->user()->status, ['sts2','sts3']))
            <li><a href="{{ route('ramalan') }}">Ramalan</a></li>
            <li class="dropdown"><a href="#"><span>Rekomendasi</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="{{ route('knapsack') }}">Knapsack</a></li>
                <li><a href="{{ route('dataKnapsack') }}">Data Knapsack</a></li>
              </li>
            </ul>
          @endif
          
          @if (Auth::guard('web')->check() || Auth::guard('karyawan')->check())
            <li><a class="nav-link scrollto" href="#contact">Pengaduan</a></li>
          @endif

          @if (Auth::guard('web')->check() or Auth::guard('karyawan')->check())
            <li class="dropdown"><a href="#"><span>
              @if (Auth::guard('web')->check())
                {{ Auth::guard('web')->user()->nama_usaha}}
              @elseif (Auth::guard('karyawan')->check())
                {{ Auth::guard('karyawan')->user()->nama}}
              @endif  
            </span>
            <img class="img-profile rounded-circle ms-2" style="width: 3vw; height: 3vw;"
            src="{{ asset('img/undraw_profile.svg') }}"></a>
              <ul>
                <li><a href="{{ route('akunUsaha') }}">Profil</a></li>
                <li><a href="" data-bs-toggle="modal" data-bs-target="#Logout">Log Out</a></li>
            </li>

          @else
            <li><a class="getstarted scrollto" href="{{ route('login') }}">Login Akun</a></li>
          @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>Better Solutions For Your Agro Business</h1>
          <h2>Operats menyediakan layanan dan fitur penunjang bisnismu</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            @if (Auth::guard('web')->check())
              <a href="{{ route('dashboard') }}" class="btn-get-started scrollto me-3">Mulai Beroperasi</a>
              @if (Auth::guard('web')->user()->status == 'sts1')
                <a href="#pricing" class="btn-get-started scrollto me-3">Get Premium</a>
              @endif
            @else
              <a href="{{ route('register') }}" class="btn-get-started scrollto me-3">Registrasi Akun</a>
            @endif
            {{-- <a href="#about" class="btn-get-started scrollto">Mulai Beroperasi</a> --}}
            {{-- <a href="#" class="getstarted glightbox btn-watch-video"><i class=""></i><span>Fitur Kami</span></a> --}}
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="{{ asset('assets/src/duitberanda.svg') }}" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Clients Section ======= -->
    {{-- <section id="clients" class="clients section-bg">
      <div class="container">

        <div class="row" data-aos="zoom-in">

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assetsBeranda/img/clients/client-1.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assetsBeranda/img/clients/client-2.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assetsBeranda/img/clients/client-3.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assetsBeranda/img/clients/client-4.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assetsBeranda/img/clients/client-5.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assetsBeranda/img/clients/client-6.png" class="img-fluid" alt="">
          </div>

        </div>

      </div>
    </section><!-- End Cliens Section --> --}}

    <!-- ======= About Us Section ======= -->
    {{-- <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
              <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <a href="#" class="btn-learn-more">Learn More</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section --> --}}

    <!-- ======= Free ======= -->
    <section id="why-us" class="why-us section-bg">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="content">
              <h3>Nikmati Fitur <strong>Free</strong> OPERATS</h3>
              <p>
                OPERATS menyediakan berbagai fitur yang dirancang khusus untuk membantu bisnis dalam mengoptimalkan kinerja dan pengembangan usahamu, 
              </p>
            </div>

            <div class="accordion-list">
              <ul>
                <li>
                  <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>01</span> Manamejem Produk <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                    <p>
                      Fitur ini dapat membantu Anda mengelola produk bisnis Anda dengan melibatkan beberapa atribut seperti tanggal kadaluwarsa, nama produk, harga, dan stok.
                    </p>
                  </div>
                </li>

                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span> Pencatatan Pendapatan <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                      Kelola pendapatan bisnismu dengan perhitungan otomatis.
                    </p>
                  </div>
                </li>

                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span> Pencatatan Pengeluaran <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                      Pantau uang yang keluar dari keuangan bisnismu untuk membantu mengelola keuangan dengan lebih efektif dan efisien.
                    </p>
                  </div>
                </li>

              </ul>
            </div>

          </div>

          <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("assets/src/fitur1.svg");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
        </div>

      </div>

      <!-- ======= Premium ======= -->
      <div class="container-fluid" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-5 align-items-stretch img" style='background-image: url("assets/src/fitur2.svg");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>

          <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="content">
              <h3>Nikmati Fitur <strong>Premium</strong> OPERATS</h3>
              <p>
                OPERATS menyediakan fitur khusus Anda yang upgrade ke premium yang dirancang untuk membantu bisnis dalam mengoptimalkan kinerja dan pengembangan usahamu, 
              </p>
            </div>

            <div class="accordion-list">
              <ul>
                <li>
                  <a data-bs-toggle="collapse" class="collapse" data-bs-target="#PREMIUMaccordion-list-1"><span>01</span> Ramalan Stok <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="PREMIUMaccordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                    <p>
                      Fitur ini dapat membantu Anda memprefiksi stok produk bisnis Anda dengan metode Eksponensial Smoothing supaya Anda dapat mengambil keputusan dari hasil prediksi.
                    </p>
                  </div>
                </li>
                <li>
                  <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#accordion-list-2"><span>02</span> Knapsack Problem <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-2" class="collapse show" data-bs-parent=".accordion-list">
                    <p>
                      Fitur ini dapat membantu Anda menyelesaikan pemilihan produk yang membantu peningkatan penjualan serta tanpa melebihi kapasitas gudang stok anda. Fitur ini memperhitungkan segala kemungkinan dengan memerhatikan indikator pendapatan tertinggi dari penjualan produk serta produk baru yang akan di masukkan ke gudang.
                    </p>
                  </div>
                </li>
              </ul>
            </div>

          </div>

        </div>

      </div>
    </section>
    <!-- End Why Us Section -->

    <!-- ======= Skills Section ======= -->
    {{-- <section id="skills" class="skills">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
            <img src="assetsBeranda/img/skills.png" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
            <h3>Voluptatem dignissimos provident quasi corporis voluptates</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>

            <div class="skills-content">

              <div class="progress">
                <span class="skill">HTML <i class="val">100%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">CSS <i class="val">90%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">JavaScript <i class="val">75%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">Photoshop <i class="val">55%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

            </div>

          </div>
        </div>

      </div>
    </section><!-- End Skills Section --> --}}

    <!-- ======= Services Section ======= -->
    {{-- <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href="">Lorem Ipsum</a></h4>
              <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Sed ut perspici</a></h4>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Magni Dolores</a></h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Nemo Enim</a></h4>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section --> --}}

    <!-- ======= Cta Section ======= -->
    {{-- <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="row">
          <div class="col-lg-9 text-center text-lg-start">
            <h3>Call To Action</h3>
            <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#">Call To Action</a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section --> --}}

    <!-- ======= Portfolio Section ======= -->
    {{-- <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Portfolio</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-app">App</li>
          <li data-filter=".filter-card">Card</li>
          <li data-filter=".filter-web">Web</li>
        </ul>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="assetsBeranda/img/portfolio/portfolio-1.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>App 1</h4>
              <p>App</p>
              <a href="assetsBeranda/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="assetsBeranda/img/portfolio/portfolio-2.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <a href="assetsBeranda/img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="assetsBeranda/img/portfolio/portfolio-3.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>App 2</h4>
              <p>App</p>
              <a href="assetsBeranda/img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assetsBeranda/img/portfolio/portfolio-4.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Card 2</h4>
              <p>Card</p>
              <a href="assetsBeranda/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="assetsBeranda/img/portfolio/portfolio-5.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Web 2</h4>
              <p>Web</p>
              <a href="assetsBeranda/img/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="assetsBeranda/img/portfolio/portfolio-6.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>App 3</h4>
              <p>App</p>
              <a href="assetsBeranda/img/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assetsBeranda/img/portfolio/portfolio-7.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Card 1</h4>
              <p>Card</p>
              <a href="assetsBeranda/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assetsBeranda/img/portfolio/portfolio-8.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Card 3</h4>
              <p>Card</p>
              <a href="assetsBeranda/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="assetsBeranda/img/portfolio/portfolio-9.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <a href="assetsBeranda/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section --> --}}

    <!-- ======= Team Section ======= -->
    {{-- <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Team</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">

          <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assetsBeranda/img/team/team-1.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Chief Executive Officer</span>
                <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assetsBeranda/img/team/team-2.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Product Manager</span>
                <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assetsBeranda/img/team/team-3.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>CTO</span>
                <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4" data-aos="zoom-in" data-aos-delay="400">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assetsBeranda/img/team/team-4.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Accountant</span>
                <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section --> --}}

    
    @if (Auth::guard('web')->check() && Auth::guard('web')->user()->status === 'sts1' )
    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Premium</h2>
          <p>Upgrade akunmu menjadi premium supaya fitur yang kamu gunakan lebih lengkap. Jadikan bisnismu lebih berpengalaman dalam menggunakan fitur yang lebih banyak dari OPERATS</p>
        </div>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
              <h3>Gratis</h3>
              <h4><sup>Rp</sup>0<span>per bulan</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Fitur manajemen stok</li>
                <li><i class="bx bx-check"></i> Fitur manajemen pendapatan</li>
                <li><i class="bx bx-check"></i> Fitur manajemen pengeluaran</li>
                <li><i class="bx bx-check"></i> Fitur Profit</li>
                <li><i class="bx bx-check"></i> Terbatas hanya 100 data</li>
                <li class="na"><i class="bx bx-x"></i> <span>Prediksi stok</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Rekomendasi Produk</span></li>
              </ul>
              <a href="{{ route('dashboard') }}" class="buy-btn">Mulai</a>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
              <h3>Premium</h3>
              <h4><sup>Rp</sup>4.999<span>per 1 bulan</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Fitur manajemen stok</li>
                <li><i class="bx bx-check"></i> Fitur manajemen pendapatan</li>
                <li><i class="bx bx-check"></i> Fitur manajemen pengeluaran</li>
                <li><i class="bx bx-check"></i> Fitur Profit</li>
                <li><i class="bx bx-check"></i> Prediksi stok</li>
                <li><i class="bx bx-check"></i> Rekomendasi Produk</li>
                <li><i class="bx bx-check"></i> Tidak ada batas data</li>
              </ul>
              <a href="{{ route('pembayaran.premium') }}" class="buy-btn" id="pay-button">pilih</a>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="box">
              <h3>Premium Pro</h3>
              <h4><sup>Rp</sup>9.999<span>per 3 bulan</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Fitur manajemen stok</li>
                <li><i class="bx bx-check"></i> Fitur manajemen pendapatan</li>
                <li><i class="bx bx-check"></i> Fitur manajemen pengeluaran</li>
                <li><i class="bx bx-check"></i> Fitur Profit</li>
                <li><i class="bx bx-check"></i> Prediksi stok</li>
                <li><i class="bx bx-check"></i> Rekomendasi Produk</li>
                <li><i class="bx bx-check"></i> Tidak ada batas data</li>
              </ul>
              <a href="{{ route('pembayaran.premiumPro') }}" class="buy-btn" id="pay-button">Pilih</a>
            </div>
          </div>

        </div>

      </div>
    </section>
    <!-- End Pricing Section -->
    @endif

    @if (isset($isPrice))
    <script>
      window.addEventListener('DOMContentLoaded', (event) => {
         var element = document.getElementById("pricing");
         element.scrollIntoView({ behavior: "smooth" });
      });
    </script>
    @endif
      

    <!-- ======= Frequently Asked Questions Section ======= -->
    {{-- <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                <p>
                  Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="500">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                </p>
              </div>
            </li>

          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section --> --}}

    @if (Auth::guard('web')->check() || Auth::guard('karyawan')->check())
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Pengaduan</h2>
          <p>Sampaikan kendalamu dalam menggunakan fitur OPERATS agar kami dapat segera melakukan maintenance terhadap masalah Anda. Sampaikan kendala Anda dengan detail melalui pesan dalam form di bawah ini!</p>
        </div>

        <div class="row">

          <div class="col-lg-6 d-flex align-items-stretch">
            <div class="info">

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>operatsggwp@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+62 812 1653 2315</p>
              </div>

              <div>
                <img src="{{ asset('assets/src/bantuan.svg') }}" alt="bantuan" class="img-fluid p-2 mt-5">
            </div>
            </div>

          </div>

          <div class="col-lg-6 rounded bg-white shadow">
            <form action="{{ route('sendMessage') }}" class="m-5" method="post" id="pengaduan">
              @csrf
              <div class="row">
                <div class="form-group col-md-6">
                  <label class="form-label" for="nama">Nama Lengkap</label>
                  <input type="text" name="nama" class="form-control" id="nama">
                </div>
                <div class="form-group col-md-6">
                  <label class="form-label" for="nomor">Nomor Handphone</label>
                  <div  class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="text" class="form-control" name="nomor" id="nomor" placeholder="81216532315">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label" for="subjek">Subjek</label>
                <input type="text" class="form-control" name="subjek" id="subjek">
              </div>
              <div class="form-group">
                <label class="form-label" for="pesan">Pesan</label>
                <textarea class="form-control" name="pesan" rows="10"></textarea>
              </div>
              <div class="text-center">
                <button class="btn btn-primary form-control mt-3 w-50" type="submit">Submit</button>
              </div>
            </form>
          </div>

        </div>

      </div>
    </section>
    <!-- End Contact Section -->
    @endif
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  {{-- <footer id="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Arsha</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Arsha</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer --> --}}

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assetsBeranda/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assetsBeranda/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assetsBeranda/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assetsBeranda/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assetsBeranda/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assetsBeranda/vendor/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('assetsBeranda/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assetsBeranda/js/main.js') }}"></script>

  <!-- sweetalert2 js -->
  <script src="{{ asset("assets/sweetalert2/dist/sweetalert2.all.min.js") }}"></script>

  @if (session('message'))
    <script>
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: "{{ session('message') }}",
      showConfirmButton: false,
      timer: 5000
    })
    window.addEventListener('DOMContentLoaded', (event) => {
         var element = document.getElementById("pengaduan");
         element.scrollIntoView({ behavior: "smooth" });
      });
    </script>    
  @endif 

  {{-- define errors pengaduan --}}
  @if ($errors->any())
    <script>
      Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Tipe data yang dimasukkan salah!',
          showConfirmButton: false,
          timer: 5000
      })
      window.addEventListener('DOMContentLoaded', (event) => {
         var element = document.getElementById("pengaduan");
         element.scrollIntoView({ behavior: "smooth" });
      });
  </script>
  @endif 

<!-- Modal LOG OUT-->
<div class="modal fade" id="Logout" tabindex="-1" aria-labelledby="LogoutLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="LogoutLabel">Ingin Keluar?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Klik log out jika Anda yakin ingin keluar, klik batal jika tidak.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>