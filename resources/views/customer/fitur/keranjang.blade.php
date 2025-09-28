@extends('layouts.customer')

@section('title', 'ohayoy-keranjang')

@section('content')

    <div class="container-w2 gap20">

        @foreach ($items as $i)
            <a href="{{ route('customer.detailMenu', $i->menu->id) }}" class="menu-box gap15">
                <div class="gambar">
                    <img src="{{ asset('storage/' . $i->menu->foto) }}" alt="" class="object-fit">
                </div>

                <div class="flex flex-between align-center w100">
                    <div class="">
                        <h3 class="title">{{ $i->menu->nama_menu}}</h3>
                        <p class="text-small">{{ $i->menu->kategori->nama_kategori }}</p>
                    </div>

                    {{-- <h3 class="text-nowrap"><i class="ri-star-fill text-medium star"></i> 4.5</h3> --}}
                </div>
            </a>
        @endforeach

    </div>

@endsection
