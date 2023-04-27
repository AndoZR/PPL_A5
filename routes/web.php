<?php

use App\Http\Controllers\c_akun;
use Illuminate\Http\Request;
use App\Http\Controllers\c_login;
use App\Http\Controllers\c_produk;
use App\Http\Controllers\c_beranda;
use App\Http\Controllers\c_register;
use Illuminate\Foundation\Auth\User;
use App\Http\Controllers\c_dashboard;
use App\Http\Controllers\c_pendapatan;
use App\Http\Controllers\c_ramalan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('beranda.beranda');
});


// ALl USER
Route::controller(c_beranda::class)->group(function () {
    Route::get('beranda', 'index')->name('beranda');
    Route::get('beranda-logged', 'index')->name('beranda.usaha')->middleware('multiAuth');
});


// -------------------- GUEST ONLY -----------------------
Route::controller(c_login::class)->prefix('login')->group(function () {
    Route::get('', 'index')->name('login');
    Route::post('', 'akses')->name('login.akses');

    // Reset password
    Route::get('/forgot-password', 'mailResetForm')->name('password.request'); //
    Route::post('/forgot-password', 'sendMailResetPassword')->name('password.email');
    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.resetPasswordForm', ['token' => $token]);
    })->name('password.reset');
    Route::post('/reset-password','updatePassword')->name('password.update');

});

Route::controller(c_register::class)->prefix('register')->group(function () {
    Route::get('', 'index')->name('register');
    Route::post('', 'simpan')->name('register.simpan');
});


// ------------------------ USER PEMILIK USAHA DAN KARYAWAN FREE AND PREMIUM ONLY -----------------
// ['auth:web', 'verified', 'checkStatus:premium,free']
Route::middleware(['multiAuth'])->group(function (){
    Route::get('dashboard', [c_dashboard::class, 'index'])->name('dashboard');
    Route::get('logout', [c_login::class, 'logout'])->name('logout');

    // Akun Usaha ZONE dengan user usaha
    Route::controller(c_akun::class)->prefix('akun-usaha')->group(function () {
        Route::get('', 'akunUsaha')->name('akunUsaha');
        Route::get('edit', 'editAkunUsaha')->name('akunUsaha.edit');
        Route::post('edit', 'editAkunUsahaProcess')->name('akunUsaha.edit.process');
    });
    
    // Akun Karyawan ZONE dengan user usaha
    Route::controller(c_akun::class)->prefix('akun-karyawan')->group(function () {
        Route::get('', 'akunKaryawan')->name('akunKaryawan');
        Route::get('tambah', 'akunKaryawanAdd')->name('akunKaryawan.tambah');
        Route::post('tambah', 'akunKaryawanAddSave')->name('akunKaryawan.tambah.save');
        Route::get('detail/{username}', 'detailKaryawan')->name('akunKaryawan.detail');
        Route::get('hapus/{username}', 'hapusKaryawan')->name('akunKaryawan.hapus');
        Route::get('edit/{username}', 'editKaryawan')->name('akunKaryawan.edit');
        Route::post('edit/{username}', 'editSimpanKaryawan')->name('akunKaryawan.edit.simpan');
    });

    // Get Premium
    route::get('', [c_akun::class, 'getPremium'])->name('getPremium');
    
    // fitur Produk
    Route::controller(c_produk::class)->prefix('produk')->group(function () {
        Route::get('', 'index')->name('produk'); //view data dengan manggil fungsi index pada controller
        Route::get('tambah', 'tambah')->name('produk.tambah'); // tambah data produk
        Route::post('tambah', 'simpan')->name('produk.tambah.simpan'); // tambah->simpan data produk
        Route::get('edit/{produk_id}', 'edit')->name('produk.edit'); // mengedit data produk
        Route::post('edit/{produk_id}', 'update')->name('produk.edit.update'); // mengedit data produk
        Route::get('hapus/{produk_id}', 'hapus')->name('produk.hapus'); // menghapus data produk
    });
    
    // fitur pendapatan
    Route::controller(c_pendapatan::class)->prefix('pendapatan')->group(function () {
        Route::get('','index')->name('pendapatan');
        Route::get('tambah','tambah')->name('pendapatan.tambah');
        Route::post('tambah','simpan')->name('pendapatan.tambah.simpan');
        Route::get('edit/{pendapatan_id}', 'edit')->name('pendapatan.edit'); 
        Route::post('edit/{pendapatan_id}', 'update')->name('pendapatan.edit.update'); 
        Route::get('hapus/{pendapatan_id}', 'hapus')->name('pendapatan.hapus'); 
        Route::post('', 'dateFilter')->name('pendapatan.dateFilter');
    });
});


// --------------------- USER PREMIUM ONLY ------------------------
Route::middleware(['auth:web', 'verified', 'checkStatus:premium'])->group(function (){
    Route::controller(c_ramalan::class)->prefix('ramalan')->group(function () {
        Route::get('', 'getPendapatanStok')->name('ramalan');
        Route::post('', 'Predict')->name('ramalan.predict');
    });
    
});



// --------------------- The Email Verification Notice -----------------
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// --------------------- The Email Verification Handler ----------------
Route::get('/email/verify/{username}/{hash}', function (EmailVerificationRequest $request,$username) {
    $request->fulfill();
    // User::where('username', $username)->update(['email_verified_at' => now()]);

    return redirect('/beranda');
})->middleware(['auth', 'signed'])->name('verification.verify');
