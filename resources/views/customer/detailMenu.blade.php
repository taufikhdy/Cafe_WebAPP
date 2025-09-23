@extends('layouts.customer')

@section('title', 'ohayoy-detail-menu')

@section('content')

    <div class="detail-menu">
        <div class="flex gap30">
            <img src="{{ asset('storage/' . $menu->foto) }}" alt="" class="detail-gambar">

            <div class="flex flex-around fd-column menu-info">
                <h2>{{ $menu->nama_menu }}</h2>
                <p>{{ $menu->kategori->nama_kategori }}</p>

                <div class="detail-badge">
                    <div class="badge text-center">
                        <h3><i class="ri-star-fill text-medium star"></i> 4.5</h3>
                        <a href="" class="badge-link">Lihat Ulasan</a>
                    </div>

                </div>
            </div>


        </div>

        <div class="deskripsi-menu">
            <h3 class="title-box">Deskripsi Menu</h3>
            <p>{{ $menu->deskripsi }}</p>
        </div>
    </div>

@endsection
