@extends('layouts.customer')

@section('title', 'ohayoy-menu')

@section('content')

    <div class="banner">
        <img src="{{ asset('images/banner.jpeg') }}" alt="" class="object-fit">
        <div class="searchbox1">
            <div class="title">
                <h3>Yuk cari menu pilihan mu!</h3>
            </div>
            <form action="" method="post">
                @csrf
                <div class="flex align-center gap10">
                    <input type="text" name="" id="" placeholder="Ketik nama menu">
                    <button type="submit" class="btn-primary"><i class="ri-search-line text-white"></i> Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-block text-center">
        <h1 class="title-box">Lagi pengen yang enak-enak?</h1>
        <p class="font-sb">Ini dia menu andalan yang paling sering bikin pelanggan balik lagi. <br>
            Siap temenin kamu kapan aja!</p>
    </div>

    <div class="container-w4 gap20">


        @foreach ($menu as $m)
            <a href="{{route('customer.detailMenu', $m->id)}}" class="menu-box gap15">
                <div class="gambar">
                    <img src="{{ asset('storage/' . $m->foto) }}" alt="" class="object-fit">
                </div>

                <div class="title">
                    <h3 class="title">{{ $m->nama_menu }}</h3>
                    <p class="text-small">{{ $m->kategori->nama_kategori }}</p>
                </div>

            </a>
        @endforeach

    </div>

    <div class="text-block text-center">
        <h1 class="title-box">Bingung mau pesen apa?</h1>
        <p class="font-sb">Tenang, kita bantu pilih sesuai selera kamu. <br>
            Mau yang manis, gurih, atau yang seger-seger?</p>
    </div>

    <div class="container-w6 gap30">
        <a href="" class="box">
            <h4>Manis</h4>
        </a>

        <a href="" class="box">
            <h4>Gurih</h4>
        </a>

        <a href="" class="box">
            <h4>Murah</h4>
        </a>
    </div>

    @include('components.footer')

@endsection
