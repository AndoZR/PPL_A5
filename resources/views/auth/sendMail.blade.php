<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/cssBootstrap/bootstrap.min.css') }}">
    <script src="{{ asset("assets/sweetalert2/dist/sweetalert2.all.min.js") }}"></script>

</head>

<body>
    <div class="container d-flex flex-column">
      <div class="row align-items-center justify-content-center
          min-vh-100">
        <div class="col-12 col-md-8 col-lg-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="mb-4">
                <h5>Form Reset Password</h5>
                <p class="mb-2">Isi email teregistrasi untuk melakukan perubahan password
                </p>
              </div>
              <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" id="email" class="form-control" name="email" placeholder="Isi email kamu"
                    required="">
                </div>
                <div class="mb-3 d-grid">
                  <button type="submit" class="btn btn-primary">
                    Reset Password
                  </button>
                </div>
                <span>Belum memiliki akun? <a href="{{ route('register') }}">Registrasi</a></span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

   @if ($errors->all())
    <script>
        Swal.fire(
        'Whoops',
           `@foreach ($errors->all() as $items)
            {{ $items }}
            <?php break ?>
            @endforeach`,
        'error'
    )
    </script>    
    @endif
    @if (session()->has('status'))
    <script>
        Swal.fire(
        'Whoops',
           `{{ session()->get('status') }}`,
        'success'
    )
    </script> 
    @endif
</body>

</html>