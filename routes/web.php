<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::controller(AdminController::class)->group(function() {
    route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
    route::get('/admin/detail-menu', 'detailMenu')->name('admin.detailMenu');
});
