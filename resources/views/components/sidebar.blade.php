<aside id="sidebar" class="sidebar">
    <div class="text-right"><i id="btn-close" class="ri-2x ri-close-fill trigger"></i></div>
    <a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('admin.report') }}" class="{{ Request::is('admin/report*') ? 'active' : '' }}">Laporan</a>
    <a href="{{ route('admin.menu') }}" class="{{ Request::is('admin/menu*') ? 'active' : '' }}">Menu</a>
    <a href="{{ route('admin.kategoriMenu') }}" class="{{ Request::is('admin/kategori-menu*') ? 'active' : '' }}">Kategori</a>
    <a href="">Meja</a>
    <a href="{{ route('admin.pengguna') }}" class="{{ Request::is('admin/pengguna*') ? 'active' : '' }}">Pengguna</a>

    <form action="{{ route('logout') }}" method="post"
        onsubmit="return confirm('Apakah anda yakin ingin keluar dari akun?')">
        @csrf
        <button type="submit" name="" id="" value="" class="logout text-left">logout</button>
    </form>
</aside>
