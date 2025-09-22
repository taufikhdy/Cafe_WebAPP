<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\OfficeController;
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

    route::get('/admin/pengguna', 'pengguna')->name('admin.pengguna');
});
