<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\OfficeController;
use App\Http\Controllers\Auth\AuthCustomerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', [OfficeController::class, 'login']);

Route::controller(OfficeController::class)->group(function () {
    route::get('/login', 'login')->name('login');
    route::post('/authenticate', 'authenticate')->name('authenticate');

    route::post('/logout', 'logout')->name('logout');

});


Route::controller(AuthCustomerController::class)->group(function () {
    route::get('/login/customer/{hash}', 'loginByQr')->name('loginByQr');
    // route::post('/authenticate', 'authenticate')->name('authenticate');
    route::post('/customer/logout', 'logout')->name('customer.logout');

});


Route::controller(AdminController::class)->group(function() {
    route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
    route::get('/admin/report', 'report')->name('admin.report');

    route::get('/admin/kategori-menu', 'kategoriMenu')->name('admin.kategoriMenu');
    route::post('/admin/kategori-menu/tambahKategori', 'tambahKategori')->name('admin.tambahKategori');
    route::delete('/admin/kategori-menu/hapusKategori/{id}', 'hapusKategori')->name('admin.hapusKategori');

    route::get('/admin/menu', 'menu')->name('admin.menu');
    route::post('/admin/menu/tambahMenu', 'tambahMenu')->name('admin.tambahMenu');
    route::delete('/admin/menu/hapusMenu/{id}', 'hapusMenu')->name('admin.hapusMenu');

    route::get('/admin/meja', 'meja')->name('admin.meja');

    route::post('/admin/meja/tambahMeja', 'tambahMeja')->name('admin.tambahMeja');
    route::delete('/admin/menu/hapusMeja/{id}', 'hapusMeja')->name('admin.hapusMeja');
    route::post('/admin/meja/buatUrl', 'buatUrl')->name('admin.buatUrl');

    route::get('/admin/pengguna', 'pengguna')->name('admin.pengguna');
    route::post('/admin/pengguna/tambahPengguna', 'tambahPengguna')->name('admin.tambahPengguna');
    route::delete('/admin/pengguna/hapusPengguna/{id}', 'hapusPengguna')->name('admin.hapusPengguna');
});



Route::controller(KasirController::class)->group(function() {
    route::get('/kasir/dashboard', 'dashboard')->name('kasir.dashboard');
});




Route::controller(CustomerController::class)->group(function() {
    route::get('/customer/validation', 'usernameForm')->name('customer.form');
    route::post('/customer/confirm', 'usernameValid')->name('customer.username.valid');
    route::get('/customer/dashboard', 'dashboard')->name('customer.dashboard');

    route::get('/customer/menu/detailMenu/{id}', 'detailMenu')->name('customer.detailMenu');

    route::get('/customer/menu', 'menu')->name('customer.menu');
    route::get('/customer/menu/cari_menu', 'cariMenu')->name('customer.cariMenu');

    route::get('/customer/keranjang', 'keranjang')->name('customer.keranjang');
});


Route::controller(KeranjangController::class)->group(function() {
    route::post('/customer/menu/detailMenu/tambahMenu', 'tambahKeranjang')->name('customer.tambahMenu');
});
