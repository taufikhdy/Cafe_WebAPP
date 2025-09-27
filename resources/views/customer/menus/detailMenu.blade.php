@extends('layouts.customer')

@section('title', 'ohayoy-detail-menu')

@section('content')


    <div class="back-link text-medium">
        <h4><a href="{{ url()->previous() }}"><i class="ri-lg ri-arrow-left-long-line"></i> detail menu</a></h4>
    </div>
    <div class="detail-menu">

        <div class="flex gap30 menu-square">
            <img src="{{ asset('storage/' . $menu->foto) }}" alt="" class="detail-gambar">

            <div class="flex flex-around fd-column menu-info">
                <h2>{{ $menu->nama_menu }}</h2>
                <p>{{ $menu->kategori->nama_kategori }}</p>
                <br>
                <p class="text-medium">Harga</p>
                <h2>{{ 'Rp. ' . number_format($menu->harga, 0, ',', '.') }}</h2>
            </div>

        </div>

        <div class="detail-badge">
            <div class="badge text-center">
                <h3><i class="ri-star-fill text-medium star"></i> 4.5</h3>
                <a href="" class="badge-link">Lihat Ulasan</a>
            </div>
        </div>

        <div class="menu-choice flex align-center gap10">
            <button class="btn-primary action-btn">
                Tambah
            </button>

            {{-- <button class="btn-primary-soft text-medium">
                Masukan ke keranjang
            </button> --}}
        </div>


        <h3 class="title-box">Deskripsi Menu</h3>
        <div class="deskripsi-menu">
            <p>{!! nl2br(e($menu->deskripsi)) !!}</p>
        </div>
    </div>

    <div class="title-box-l text-center">
        <h3>Kamu mungkin juga suka!</h3>
    </div>

    <div class="container-w4 gap20">

        @foreach ($rekomendasi as $m)
            <a href="{{ route('customer.detailMenu', $m->id) }}" class="menu-box gap15">
                <div class="gambar">
                    <img src="{{ asset('storage/' . $m->foto) }}" alt="" class="object-fit">
                </div>

                <div class="flex flex-between align-center w100">
                    <div class="">
                        <h3 class="title">{{ $m->nama_menu }}</h3>
                        <p class="text-small">{{ $m->kategori->nama_kategori }}</p>
                    </div>

                    <h3 class="text-nowrap"><i class="ri-star-fill text-medium star"></i> 4.5</h3>
                </div>
            </a>
        @endforeach

    </div>

    <div class="title-box w100 text-center">
        <a href="{{ route('customer.menu') }}" class="btn-primary-soft">Lihat lebih banyak</a>
    </div>

@endsection
