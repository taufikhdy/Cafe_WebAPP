@extends('layouts.main')

@section('title', 'ohayoy-menu')

@section('content')

    <div class="content">

        <div class="container-w2">
            <div class="">
                <div class="element-title">
                    <h3>Menu terlaris</h3>
                </div>

                @foreach ($terlaris as $t)
                    <li class="list-item">
                        <div class="name">{{ $t->nama_menu }}</div>
                        <div class="order">{{ $t->penjualan }} Terjual</div>
                    </li>
                @endforeach
                </ul>
            </div>

            <div id="cateForm" class="menuCate">
                <div class="element-title flex">
                    <h3>Tambah Kategori</h3>
                    <button id="cateSwitch" class="btn-blue">Tambah Menu</button>
                </div>

                <div class="box">
                    <form action="{{ route('admin.tambahKategori') }}" method="post">
                        @csrf
                        <div class="flex align-center gap15">
                            <input type="text" name="nama_kategori" id="" placeholder="Nama Kategori" required>
                            <input type="submit" name="" id="" class="btn-primary" value="Tambah">
                        </div>
                    </form>
                </div>
            </div>


            <div id="menuForm" class="menuForm on">
                <div class="element-title flex">
                    <h3>Tambah Menu</h3>
                    <button id="menuSwitch" class="btn-blue">Tambah Kategori</button>
                </div>

                <div class="box">
                    <form action="{{ route('admin.tambahMenu') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="flex align-center gap15" style="margin: 10px 0px;">
                            <input type="text" name="nama_menu" id="" placeholder="Nama Menu" required>
                            <input type="number" name="harga" id="" placeholder="Harga Menu" required>
                        </div>

                        <div class="flex align-center gap15 flex-wrap" style="margin: 10px 0px;">
                            <select name="status_stok" id="" class="btn-blue" required>
                                <option value="">Status Stok</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="tidak_tersedia">Tidak Tersedia</option>
                            </select>
                            <select name="kategori_id" id="" class="btn-blue" required>
                                <option value="">-- Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>

                            <label for="foto" class="btn-blue text-small"><i
                                    class="ri-image-add-line text-medium text-white"></i> Pilih gambar</label>
                            <input type="file" name="gambar_menu" id="foto" class="file">
                        </div>

                        <textarea name="deskripsi" id="" cols="" rows="" class="textarea1"
                            placeholder="Deskripsi menu, contoh:Kopi susu dengan krim yang lembut"></textarea>

                        <input type="submit" class="btn-primary" value="Tambah">
                    </form>
                </div>
            </div>
        </div>

        <div class="container-w1">
            <div class="flex align-center flex-between">
                <div class="element-title">
                    <h3>Tabel Menu</h3>
                </div>
                <div class="flex align-center gap10">
                    <button>Terlaris</button>
                    <button>Terbaru</button>
                </div>
            </div>

            <div class="table-container">
                <table class="table">


                    @if ($menus->isEmpty())
                        <tr>
                            <p class="text-center">Belum ada data menu</p>
                        </tr>
                    @else
                        <tr>
                            <th>No</th>
                            <th>Gambar Menu</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Status Stok</th>
                            <th>Penjualan</th>
                            <th>Aksi</th>
                        </tr>

                        @php
                            $no = 1;
                        @endphp

                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td class="tape"><img src="{{ asset('storage/' . $menu->foto) }}"
                                        alt="{{ $menu->nama_menu }}"></td>
                                <td>{{ $menu->nama_menu }}</td>
                                <td>{{ 'Rp. ' . number_format($menu->harga, 0, ',', '.') }}</td>
                                <td>

                                    <form action="{{ route('admin.menu.status') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <select name="status_stok" class="btn-blue option">
                                            <option value="{{ $menu->status_stok }}">{{ $menu->status_stok }}</option>
                                            <option value="tersedia">Tersedia</option>
                                            <option value="tidak_tersedia">Tidak Tersedia</option>
                                        </select>

                                        <button type="submit" class="btn-blue check-button option-btn"><i
                                                class="ri-xl ri-check-fill white"></i></button>
                                    </form>

                                </td>
                                <td>{{$menu->penjualan}} Terjual</td>
                                <td>
                                    <div class="flex align-center flex-center gap10">
                                        <button class="btn-yellow">Edit</button>
                                        <form action="{{ route('admin.hapusMenu', $menu->id) }}" method="post"
                                            onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-red">hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>

    </div>

@endsection
