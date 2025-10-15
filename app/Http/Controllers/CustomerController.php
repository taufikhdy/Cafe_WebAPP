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
use App\Models\Rating;
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
        if (!Auth::guard('meja')->check() or Auth::guard('meja')->user()->role_id !== 3) {
            abort(403, 'Akses ditolak');
        }
    }

    public function usernameForm()
    {
        $this->customer();
        return view('auth.customer');
    }

    public function usernameValid(Request $request)
    {
        $this->customer();

        $request->validate([
            'username' => 'required|string|min:5|max:12'
        ]);

        $mejaId = Auth::guard('meja')->user()->id;

        if (Auth::guard('meja')->user()->username === null) {
            $meja = Meja::findorFail($mejaId);
            $meja->username = $request->username;
            $meja->save();
        }

        return redirect()->route('customer.dashboard');
    }

    public function dashboard()
    {
        $this->customer();


        $menu = Menu::withAvg('rating', 'nilai')->withCount('rating')->get();
        // $menu = Menu::latest()->get();

        return view('customer.dashboard', compact('menu'));
    }

    public function detailMenu($id)
    {
        $this->customer();
        $menu = Menu::where('id', $id)->withAvg('rating', 'nilai')->withCount('rating')->first();

        $rekomendasi = Menu::withAvg('rating', 'nilai')->withCount('rating')->inRandomOrder()->limit(20)->get();

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
        // $menu = Menu::latest()->get();
        // $menuId = Hashids::encode($menu->id);
        $menu = Menu::withAvg('rating', 'nilai')->withCount('rating')->latest()->get();

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

        $menus = $result->withAvg('rating', 'nilai')->withCount('rating')->get();

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

        if (!$keranjang) {
            $items = [];
        } else {
            $items = KeranjangItem::where('keranjang_id', $keranjang->id)->latest()->get();
        }

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

        return redirect()->route('customer.detailMenu', $request->menu_id);
    }


    public function orders()
    {
        $this->customer();

        $mejaId = Auth::guard('meja')->id();
        $orders = Order::where('meja_id', $mejaId)->with('items.menu')->latest()->get();
        $total_bayar = Order::where('meja_id', $mejaId)->sum('total_harga');

        return view('customer.fitur.order', compact('orders', 'total_bayar'));
    }


    public function orderMenu(Request $request)
    {
        $this->customer();
        $mejaId = Auth::guard('meja')->id();

        $itemIds = $request->items ?? [];
        $jumlahs = $request->jumlah ?? [];

        if (empty($itemIds)) {
            return back()->with('error', 'tidak ada menu yang dipilih');
        }

        $order = Order::create([
            'meja_id' => $mejaId,
            'total_harga' => 0
        ]);

        $total = 0;

        foreach ($itemIds as $itemId) {
            $item = KeranjangItem::with('menu')->find($itemId);

            if (!$item) continue;

            $qty = $jumlahs[$itemId] ?? $item->jumlah;

            $subtotal = $qty * $item->menu->harga;
            $total += $subtotal;


            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item->menu->id,
                'jumlah' => $qty,
                'harga_satuan' => $item->menu->harga,
                'subtotal' => $subtotal
            ]);

            $menu = Menu::where('id', $item->menu->id)->first();

            $menu->penjualan += $qty;
            $menu->save();

            $item->delete();
        }

        $order->update([
            'total_harga' => $total
        ]);


        return redirect()->route('customer.orders');
    }



    public function ulasan($id)
    {
        $this->customer();

        // $menu = Menu::findOrFail($id);
        $menu = Menu::where('id', $id)->withAvg('rating', 'nilai')->withCount('rating')->first();
        $ulasan = Rating::where('menu_id', $id)->latest()->get();

        return view('customer.menus.ulasan', compact('menu', 'ulasan'));
    }

    public function tambahUlasan(Request $request)
    {
        $this->customer();

        $request->validate([
            'nilai' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:255'
        ]);

        $mejaId = $request->meja_id;
        $menuId = $request->menu_id;

        $punyaOrder = Order::where('meja_id', $mejaId)->where('status', 'ordered')->exists();

        if(!$punyaOrder)
        {
            return back();
        }

        // $sudahRating = Rating::where('menu_id', $menuId)->where('meja_id', $mejaId)->exists();

        // if($sudahRating)
        // {
        //     return back();
        // }

        Rating::create([
            'menu_id' => $menuId,
            'meja_id' => $mejaId,
            'username' => Auth::guard('meja')->user()->username,
            'nilai' => $request->nilai,
            'ulasan' => $request->ulasan
        ]);

        return redirect()->back();
    }
}
