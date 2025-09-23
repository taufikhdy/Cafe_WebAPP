<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\OfficeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KasirController;
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

Route::controller(AdminController::class)->group(function() {
    route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
    route::get('/admin/report', 'report')->name('admin.report');

    route::get('/admin/kategori-menu', 'kategoriMenu')->name('admin.kategoriMenu');
    route::post('/admin/tambahKategori', 'tambahKategori')->name('admin.tambahKategori');
    route::delete('/admin/hapusKategori/{id}', 'hapusKategori')->name('admin.hapusKategori');

    route::get('/admin/menu', 'menu')->name('admin.menu');
    route::post('/admin/menu/tambahMenu', 'tambahMenu')->name('admin.tambahMenu');
    route::delete('/admin/menu/hapusMenu/{id}', 'hapusMenu')->name('admin.hapusMenu');

    route::get('/admin/pengguna', 'pengguna')->name('admin.pengguna');
    route::post('/admin/tambahPengguna', 'tambahPengguna')->name('admin.tambahPengguna');
});



Route::controller(KasirController::class)->group(function() {
    route::get('/kasir/dashboard', 'dashboard')->name('kasir.dashboard');
});




Route::controller(CustomerController::class)->group(function() {
    route::get('/customer/dashboard', 'dashboard')->name('customer.dashboard');

    route::get('/customer/detailMenu/{id}', 'detailMenu')->name('customer.detailMenu');
});
