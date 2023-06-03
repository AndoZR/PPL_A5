<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    {{-- <meta http-equiv="refresh" content="1"> --}}
    <title>Pembayaran | OPERATS</title>
    <link rel="stylesheet" href="{{ url('assets/cssBootstrap/bootstrap.min.css') }}">
    <script src="{{ asset("assets/sweetalert2/dist/sweetalert2.all.min.js") }}"></script>
    
    <!-- MIDTRANS SESSION -->
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
</head>
<body class="bg-primary bg-opacity-25">
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
                                <h2>Pembayaran</h2>
                                <h6>Silahkan cek data Anda untuk melanjutkan pembayaran!</h6>
                            </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label" for="nama_usaha">Nama Usaha</label>
                                        <input disabled value="{{ $dataVerif['nama_usaha'] }}" class="form-control" type="text" id="nama_usaha" name="nama_usaha">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label" for="no_handphone">No Handphone</label>
                                        <input disabled value="{{ $dataVerif['nomor'] }}" class="form-control" type="text" id="no_handphone" name="nomor_handphone">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input disabled value="{{ $dataVerif['email'] }}" class="form-control" type="text" id="email" name="email">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="biaya">Biaya</label>
                                        <input disabled value="Rp {{ $dataVerif['nominal'] }}" class="form-control" type="text" id="biaya" name="biaya">
                                    </div>
                                    <div class="text-center">
                                        <button id="pay-button" class="btn btn-primary form-control mt-4 w-50" type="submit">Pilih Pembayaran</button>
                                    </div>
                                </div>
                            <div class="text-center mt-0 mb-4">
                                <span>Ada kesalahan data, silahakan ubah data <a href="{{ route('akunUsaha') }}">Klik Di sini</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @livewireScripts
</body>

<script type="text/javascript">
  // For example trigger on button clicked, or any time you need
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', function () {
    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
    window.snap.pay('{{ $snapToken }}', {
      onSuccess: function(result){
        /* You may add your own implementation here */
        alert("payment success!"); console.log(result);
      },
      onPending: function(result){
        /* You may add your own implementation here */
        alert("wating your payment!"); console.log(result);
      },
      onError: function(result){
        /* You may add your own implementation here */
        alert("payment failed!"); console.log(result);
      },
      onClose: function(){
        /* You may add your own implementation here */
        alert('you closed the popup without finishing the payment');
      }
    })
  });
</script>
</html>