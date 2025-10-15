@extends('layouts.main')

@section('title', 'ohayoy-rating-menu')

@section('content')

    <div class="content">

        <div class="container-w1">
            <a href="{{ route('admin.menu') }}">
                <h3 class="element-title"><i class="ri-lg ri-arrow-left-long-line"></i> Ulasan Menu </h3>
            </a>

            <div class="element-title">
                {{-- <div class="flex align-center"> --}}
                    <h3>{{ $menu->nama_menu }} <i class="ri-star-fill star"></i> {{number_format($menu->rating_avg_nilai, 1)}}</h3>
                {{-- </div> --}}
            </div>

            <div class="flex fd-column gap15">
                @foreach ($ulasan as $u)
                    <div class="box">
                        <div class="flex flex-between">
                            <h4 class="mb20">{{ $u->username }} ({{ $u->meja->nama_meja }})</h4>
                            <p class="text-small">{{ $u->created_at->format('d-M-Y') }}</p>
                        </div>
                        <p>{{ $u->ulasan }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@endsection
