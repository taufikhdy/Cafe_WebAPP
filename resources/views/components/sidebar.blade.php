<aside id="sidebar" class="sidebar">
    @if(Auth::user()?->role->id === 1)
        <div class="text-right"><i id="btn-close" class="ri-2x ri-close-fill trigger"></i></div>
        {{-- <a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}">Beranda</a> --}}
        <a href="{{ route('admin.report') }}" class="{{ Request::is('admin/report*') ? 'active' : '' }}">Laporan</a>
        <a href="{{ route('admin.menu') }}" class="{{ Request::is('admin/menu*') ? 'active' : '' }}">Menu</a>
        <a href="{{ route('admin.kategoriMenu') }}" class="{{ Request::is('admin/kategori-menu*') ? 'active' : '' }}">Kategori</a>
        <a href="{{ route('admin.meja') }}" class="{{ Request::is('admin/meja*') ? 'active' : '' }}">Meja</a>
        <a href="{{ route('admin.pengguna') }}" class="{{ Request::is('admin/pengguna*') ? 'active' : '' }}">Pengguna</a>

        <form action="{{ route('logout') }}" method="post"
            onsubmit="return confirm('Apakah anda yakin ingin keluar dari akun?')">
            @csrf
            <input type="hidden" name="id_user" id="" value="{{Auth::user()->id}}">
            <button type="submit" name="" id="" value="" class="logout text-left">keluar</button>
        </form>
    @elseif(Auth::user()?->role->id === 2)
        <div class="text-right"><i id="btn-close" class="ri-2x ri-close-fill trigger"></i></div>
        <a href="{{ route('kasir.dashboard') }}" class="{{ Request::is('kasir/dashboard*') ? 'active' : '' }}">Beranda</a>
        <a href="" class="{{ Request::is('') ? 'active' : '' }}">Pesanan</a>
        <a href="" class="{{ Request::is('') ? 'active' : '' }}">Transaksi</a>
        <a href="" class="{{ Request::is('') ? 'active' : '' }}">Menu</a>

        <a href="" class="{{ Request::is('') ? 'active' : '' }}">Pengguna</a>

        <form action="{{ route('logout') }}" method="post"
            onsubmit="return confirm('Apakah anda yakin ingin keluar dari akun?')">
            @csrf
            <input type="hidden" name="id_user" id="" value="{{Auth::user()->id}}">
            <button type="submit" name="" id="" value="" class="logout text-left">keluar</button>
        </form>

    @elseif (Auth::guard('meja')->user()->role->id === 3)
        <div class="text-right"><i id="btn-close" class="ri-2x ri-close-fill trigger"></i></div>
        <a href="{{ route('customer.dashboard') }}" class="{{ Request::is('customer/dashboard*') ? 'active' : '' }}">Beranda</a>
        <a href="" class="{{ Request::is('customer/rekomendasi*') ? 'active' : '' }}">Rekomendasi</a>
        <a href="{{ route('customer.menu') }}" class="{{ Request::is('customer/menu*') ? 'active' : '' }}">Menu</a>


        <form action="{{ route('customer.logout') }}" method="post"
            onsubmit="return confirm('Apakah anda yakin ingin keluar dari akun?')">
            @csrf
            <input type="hidden" name="id_user" id="" value="{{Auth::guard('meja')->user()->id}}">
            <button type="submit" name="" id="" value="" class="logout text-left">keluar</button>
        </form>
    @endif

</aside>
