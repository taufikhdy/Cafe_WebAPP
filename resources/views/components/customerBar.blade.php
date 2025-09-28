<nav class="top-navbar">
    <div class="flex align-center gap10">
        <div id="btnside">
            <i class="ri-lg ri-menu-fill trigger"></i>
        </div>
        <div class="logo">
            <h3>Ohayoy</h3>
        </div>

        @if (Auth::guard('meja')->user()?->role->id === 3)
            <div class="navigation">
                <a href="{{ route('customer.dashboard') }}"
                    class="box-link {{ Request::is('customer/dashboard*') ? 'active' : '' }}">Beranda</a>
                <a href=""
                    class="box-link {{ Request::is('customer/rekomendasi*') ? 'active' : '' }}">Rekomendasi</a>
                <a href="{{ route('customer.menu') }}"
                    class="box-link {{ Request::is('customer/menu*') ? 'active' : '' }}">Menu</a>
                <form action="{{ route('customer.logout') }}" method="post"
                    onsubmit="return confirm('Apakah anda yakin ingin keluar dari akun?')" class="inline">
                    @csrf
                    <input type="hidden" name="id_user" id="" value="{{ Auth::guard('meja')->user()->id }}">
                    <button type="submit" name="" id=""
                        class="box-link logout text-small">keluar</button>
                </form>
            </div>
        @endif
    </div>

    <div class="flex align-center gap20">
        <div class="text-right">
            <h3>{{ Auth::guard('meja')->user()->username }}</h3>
            <p class="text-small">{{ Auth::guard('meja')->user()->role->nama_role }}</p>
        </div>
    </div>
</nav>
