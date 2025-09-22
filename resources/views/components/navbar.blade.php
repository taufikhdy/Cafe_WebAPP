<nav class="top-navbar">
    <div class="flex align-center gap10">
        <div id="btnside">
            <i class="ri-lg ri-menu-fill trigger"></i>
        </div>
        <div class="logo">
            <h3>Ohayoy</h3>
        </div>
    </div>

    <div class="">
        <h3>{{ Auth::user()->role?->nama_role }}</h3>
    </div>
</nav>
