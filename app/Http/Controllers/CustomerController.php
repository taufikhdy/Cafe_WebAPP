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

class CustomerController extends Controller
{
    //

    protected function admin()
    {
        if (!Auth::check() or Auth::user()?->role_id !== 1) {
            abort(403, 'Akses ditolak');
        }
    }

    public function dashboard()
    {
        $menu = Menu::latest()->get();
        return view('customer.dashboard', compact('menu'));
    }

    public function detailMenu($id)
    {
        $menu = Menu::findOrFail($id);
        return view('customer.detailMenu', compact('menu'));
    }
}
