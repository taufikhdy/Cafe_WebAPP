@extends('layouts.main')

@section('title', 'ohayoy-kategori-menu')

@section('content')

    {{-- <div class="">
    <form action="">
        <h3 class="element-title">Tambah Kategori</h3>
        <input type="text" name="" id="" placeholder="Nama Kategori">
        <input type="submit" value="">
    </form>
</div> --}}
    <div class="content">
        <div class="container-w1">

            <div class="element-title">
                <h3>Kategori</h3>
            </div>
            <div class="list">
                @if ($kategoris->isEmpty())
                    <p class="text-center element-title">Tidak ada kategori</p>
                @else
                    @foreach ($kategoris as $kategori)
                        <li class="list-item">
                            <p>{{ $kategori->nama_kategori }}</p>
                            <form action="{{ route('admin.hapusKategori', $kategori->id) }}" method="post"
                                onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <input type="submit" name="" id="" class="btn-red" value="Hapus">
                            </form>
                        </li>
                    @endforeach
                @endif
            </div>

        </div>
    </div>

@endsection
