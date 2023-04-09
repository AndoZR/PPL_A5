<?php

use App\Http\Controllers\c_beranda;
use App\Http\Controllers\c_dashboard;
use App\Http\Controllers\c_login;
use App\Http\Controllers\c_produk;
use App\Http\Controllers\c_register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::controller(c_dashboard::class)->prefix('dashboard')->group(function () {
    Route::get('', 'index')->name('dashboard');
});


Route::controller(c_produk::class)->prefix('produk')->group(function () {
    Route::get('', 'index')->name('produk'); //view data dengan manggil fungsi index pada controller
    Route::get('tambah', 'tambah')->name('produk.tambah'); // tambah data produk
    Route::post('tambah', 'simpan')->name('produk.tambah.simpan'); // tambah->simpan data produk
    Route::get('edit/{produk_id}', 'edit')->name('produk.edit'); // mengedit data produk
    Route::post('edit/{produk_id}', 'update')->name('produk.tambah.update'); // mengedit data produk
    Route::get('hapus/{produk_id}', 'hapus')->name('produk.hapus'); // menghapus data produk
}); // prefix untuk penamaan url


Route::controller(c_register::class)->prefix('register')->group(function () {
    Route::get('', 'index')->name('register');
    Route::post('', 'simpan')->name('register.simpan');
});


Route::controller(c_login::class)->prefix('login')->group(function () {
    Route::get('', 'index')->name('login');
    Route::get('akses', 'akses')->name('login.akses');
});


// Route::resource('beranda', c_beranda::class);
// Route::resource('login', c_login::class);
