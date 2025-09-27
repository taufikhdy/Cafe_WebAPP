<nav class="top-navbar">
    <div class="flex align-center gap10">
        <div id="btnside">
            <i class="ri-lg ri-menu-fill trigger"></i>
        </div>
        <div class="logo">
            <h3>Ohayoy</h3>
        </div>

        @if (Auth::user()?->role->id === 3)
            <div class="navigation">
                <a href="{{ route('customer.dashboard') }}"
                    class="box-link {{ Request::is('customer/dashboard*') ? 'active' : '' }}">Beranda</a>
                <a href=""
                    class="box-link {{ Request::is('customer/rekomendasi*') ? 'active' : '' }}">Rekomendasi</a>
                <a href="{{ route('customer.menu') }}"
                    class="box-link {{ Request::is('customer/menu*') ? 'active' : '' }}">Menu</a>
            </div>
        @endif
    </div>

    <div class="flex align-center gap20">
        <div class="text-right">
            <h3>{{ Auth::user()->name }}</h3>
            <p class="text-small">{{ Auth::user()->role->nama_role }}</p>
        </div>
        <a href="{{ route('customer.keranjang') }}"><i class="ri-xl ri-shopping-basket-2-line cart-link"></i></a>
    </div>
</nav>
