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

class AdminController extends Controller
{

    protected function admin()
    {
        if (!Auth::check() or Auth::user()?->role_id !== 1) {
            abort(403, 'Akses ditolak');
        }
    }

    public function dashboard()
    {
        $this->admin();
        return view('admin.dashboard');
    }

    public function report()
    {
        $this->admin();
        return view('admin.report');
    }



    public function kategoriMenu()
    {
        $this->admin();

        $kategoris = Kategori::all();
        return view('admin.kategoriMenu', compact('kategoris'));
    }

    public function tambahKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string'
        ]);

        Kategori::create($request->all());
        return redirect()->route('admin.menu')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function hapusKategori($id)
    {
        Kategori::findOrFail($id)->delete();
        return redirect()->route('admin.menu')->with('success', 'Kategori berhasil dihapus!');
    }



    public function menu()
    {
        $this->admin();
        $kategoris = Kategori::all();
        $menus = Menu::latest()->get();
        return view('admin.menu', compact('kategoris', 'menus'));
    }

    public function tambahMenu(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'stok' => 'nullable|integer',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori_id' => 'required|exists:kategori,id'
        ]);

        $pathFoto = null;
        if($request->hasFile('gambar_menu'))
        {
            $pathFoto = $request->file('gambar_menu')->store('menu', 'public');
        }

        Menu::create([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok ?? 0,
            'foto' => $pathFoto,
            'kategori_id' => $request->kategori_id,
        ]);
        return redirect()->route('admin.menu')->with('success', 'Menu baru berhasil ditambahkan!');
    }

    public function hapusMenu($id)
    {
        Menu::findOrFail($id)->delete();
        return redirect()->route('admin.menu');
    }




    public function pengguna()
    {
        $this->admin();

        $role = Roles::all();
        $user = User::all();
        return view('admin.pengguna', compact('role', 'user'));
    }

    public function tambahPengguna(Request $request)
    {
        $this->admin();

        $request->validate([
            'name' => 'string|required',
            'password' => 'string|required',
            'role_id' => 'required|exists:roles,id',
            'foto' => 'string|nullable'
        ]);

        User::create($request->all());

        return redirect()->route('admin.pengguna');
    }
}
