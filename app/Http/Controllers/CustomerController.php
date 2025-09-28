<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Roles;
use App\Models\User;
use App\Models\Meja;
use App\Models\Keranjang;
use App\Models\KeranjangItem;
use App\Models\Order;
use App\Models\OrderItem;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Vinkla\Hashids\Facades\Hashids;

class CustomerController extends Controller
{
    //

    protected function customer()
    {
        if(!Auth::guard('meja')->check() or Auth::guard('meja')->user()->role_id !== 3) {
            abort(403, 'Akses ditolak');
        }
    }

    public function usernameForm(){
        $this->customer();
        return view('auth.customer');
    }

    public function usernameValid(Request $request){
        $this->customer();

        $request->validate([
            'username' => 'required|string|min:8|max:12'
        ]);

        $mejaId = Auth::guard('meja')->user()->id;

        if(Auth::guard('meja')->user()->username === null){
            $meja = Meja::findorFail($mejaId);
            $meja->username = $request->username;
            $meja->save();
        }

        return redirect()->route('customer.dashboard');

    }

    public function dashboard()
    {
        $this->customer();


        $menu = Menu::latest()->get();
        return view('customer.dashboard', compact('menu'));
    }

    public function detailMenu($id)
    {
        $this->customer();
        $menu = Menu::findOrFail($id);

        $rekomendasi = Menu::inRandomOrder()->limit(20)->get();

        return view('customer.menus.detailMenu', compact('menu', 'rekomendasi'));

        // if (
        //     $menu->kategori->nama_kategori === 'makanan'
        //     || $menu->kategori->nama_kategori === 'kuah'
        //     || $menu->kategori->nama_kategori === 'gurih'
        // ) {
        //     $minuman = Menu::where('kategori', 'minuman')->inRandomOrder()->limit(10)->get();
        //     $makanan = Menu::where('kategori', 'makanan')->inRandomOrder()->limit(10)->get();

        //     $rekomendasi = $minuman->merge($makanan);
        //     return view('customer.menus.detailMenu', compact('menu', 'rekomendasi'));
        // }

        // elseif (
        //     $menu->kategori->nama_kategori === 'minuman'
        //     || $menu->kategori->nama_kategori === 'manis'
        // ) {
        //     $makanan = Menu::where('kategori', 'makanan')->inRandomOrder()->limit(10)->get();
        //     $minuman = Menu::where('kategori', 'minuman')->inRandomOrder()->limit(10)->get();

        //     $rekomendasi = $makanan->merge($minuman);
        //     return view('customer.menus.detailMenu', compact('menu', 'rekomendasi'));
        // }

    }


    public function menu()
    {
        $this->customer();
        $menu = Menu::latest()->get();
        // $menuId = Hashids::encode($menu->id);

        return view('customer.menus.menu', compact('menu'));
    }

    public function cariMenu(Request $request)
    {
        $this->customer();
        $search = $request->search;

        $result = Menu::query();

        if ($request->has('search') && $request->search != '') {

            $result = Menu::where('nama_menu', 'like', '%' . "$request->search" . '%');
        }

        $menus = $result->latest()->get();

        return view('customer.menus.result', compact(
            'search',
            'menus',
        ));
    }


    public function keranjang()
    {
        $this->customer();

        $mejaId = Auth::guard('meja')->id();
        $keranjang = Keranjang::where('meja_id', $mejaId)->first();
        $items = KeranjangItem::where('keranjang_id', $keranjang->id)->latest()->get();

        return view('customer.fitur.keranjang', compact('items'));
    }

    public function tambahKeranjang(Request $request, $mejaId)
    {
        $this->customer();

        $request->validate([
            'menu_id' => 'required|exists:menu,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        // CARI KERANJANG AKTIF MILIK MEJA
        $keranjang = keranjang::firstOrCreate(
            ['meja_id' => $mejaId, 'status' => 'active'], //syarat kondisi
            ['status' => 'active'] //nilai default jika keranjang belum ada
        );

        // CEK MENU SUDAH ADA DI KERANJANG ATAU BELUM
        $item = KeranjangItem::where('keranjang_id', $keranjang->id)->where('menu_id', $request->menu_id)->first();

        if ($item) {
            $item->update([
                'jumlah' => $item->jumlah += $request->jumlah
            ]);
        } else {
            // KALAU BELUM ADA BUAT BARU
            KeranjangItem::create([
                'keranjang_id' => $keranjang->id,
                'menu_id' => $request->menu_id,
                'jumlah' => $request->jumlah
            ]);
        }

        return redirect()->back();
    }
}
