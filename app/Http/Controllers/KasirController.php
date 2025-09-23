<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class KasirController extends Controller
{
    protected function kasir()
    {
        if (!Auth::check() or Auth::user()?->role_id !== 2) {
            abort(403, 'Akses ditolak');
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
