<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Meja;
use App\Models\Keranjang;
use App\Models\KeranjangItem;
use App\Models\OrderItem;
use App\Models\Transaksi;
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

    public function pesananData()
    {
        $this->kasir();

        return response()->json([
            'pesanan' => Order::where('status', 'pending')->with(['items.menu', 'meja'])->latest()->get(),
        ]);
    }

    public function pesananSelesai()
    {
        $this->kasir();

        return response()->json([
            'order_selesai' => Order::with(['items.menu', 'meja'])->where('status', 'ordered')->get()->groupBy('meja_id')
        ]);
    }


    public function pesanan()
    {
        $this->kasir();

        return view('kasir.pesanan');
    }

    public function transaksi()
    {
        $transaksi = Transaksi::where('tanggal', today())->count();

        $data = Transaksi::latest()->get();

        $pemasukan = Transaksi::where('tanggal', today())->sum('total_bayar');
        $pemasukan_bulanan = Transaksi::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('total_bayar');

        return view('kasir.transaksi', compact('transaksi', 'data', 'pemasukan', 'pemasukan_bulanan'));
    }

    public function konfirmasiPesanan(Request $request)
    {
        $this->kasir();

        $request->validate([
            'order_id' => 'required|exists:order,id'
        ]);

        $orderId = $request->order_id;

        $kasir = Auth::user()->name;

        $order = Order::findOrFail($orderId);

        if ($order) {
            $order->update([
                'status' => 'ordered'
            ]);
        }

        return redirect()->route('kasir.pesanan');
    }

    public function pelangganSelesai(Request $request)
    {
        $this->kasir();
        $request->validate([
            'meja_id' => 'required|exists:meja,id'
        ]);

        $mejaId = $request->meja_id;
        $kasir = Auth::user()->id;

        $orderId = Order::with('meja')->where('meja_id', $mejaId)->pluck('id')->implode('');

        $namaPelanggan = Order::with('meja')->where('meja_id', $mejaId)->first()->meja->username;

        // dd($order->meja,$order->meja->username);

        $total = Order::where('meja_id', $mejaId)->where('status', 'ordered')->sum('total_harga');

        if ($orderId) {
            $transaksi = Transaksi::create([
                'no_struk' => 'n',
                'meja_id' => $mejaId,
                'nama_pelanggan' => $namaPelanggan,
                // 'nama_pelanggan' => 'nama',
                'order_id' => $orderId,
                'kasir_id' => $kasir,
                'total_bayar' => $total,
                'status_bayar' => 'paid',
                'waktu' => now()->format('H:i:s'),
                'tanggal' => now()->format('Y-m-d')
            ]);

            $transaksi->no_struk = 'STRK-' . date('Ymd') . '-' . $transaksi->id;
            $transaksi->save();
        }

        return redirect()->route('kasir.struk', $mejaId);
    }

    public function struk($mejaId)
    {
        $this->kasir();

        $transaksi = Transaksi::where('meja_id', $mejaId)->latest()->first();

        $order_item = Order::where('meja_id', $mejaId)->with('items.menu')->get()->groupBy('meja_id');

        return view('kasir.struk', compact('transaksi', 'order_item'));
    }

    public function resetOrder(Request $request)
    {
        $this->kasir();

        $request->validate([
            'meja_id' => 'required|exists:meja,id'
        ]);

        $mejaId = $request->meja_id;

        $meja = meja::findOrFail($mejaId);
        $meja->update([
            'username' => null,
            'status' => 'kosong'
        ]);
        $meja->save();

        Order::where('meja_id', $mejaId)->delete();
        // OrderItem::where('order_id', $order->id)->delete();

        $keranjang = Keranjang::where('meja_id', $mejaId)->first();
        KeranjangItem::where('keranjang_id', $keranjang->id)->delete();
        $keranjang->delete();

        return redirect()->route('kasir.pesanan');
    }

    public function menu()
    {
        $this->kasir();

        $menus = Menu::latest()->get();
        return view('kasir.menu', compact('menus'));
    }

    public function menuStatus(Request $request)
    {
        $this->kasir();

        $request->validate([
            'menu_id' => 'string|required',
            'status_stok' => 'string|required'
        ]);

        $menuStatus = Menu::where('id', $request->menu_id)->first();

        $menuStatus->status_stok = $request->status_stok;
        $menuStatus->save();

        return redirect()->route('kasir.menu');
    }
}
