@extends('layouts.main')

@section('title', 'ohayoy-menu')

@section('content')

    <div class="content">

        <div class="element-title">
            <h3>Menu</h3>
        </div>

        <div class="container-w2">
            <div class="">
                <div class="element-title">
                    <h3>Menu terlaris</h3>
                </div>

                <li class="list-item">
                    <div class="name">Brew Coffe</div>
                    <div class="order">150 Terjual</div>
                </li>
                <li class="list-item">
                    <div class="name">TirramisuCake</div>
                    <div class="order">148 Terjual</div>
                </li>
                <li class="list-item">
                    <div class="name">Italian Chocolate</div>
                    <div class="order">140 Terjual</div>
                </li>
                <li class="list-item">
                    <div class="name">Kopi Hitam</div>
                    <div class="order">140 Terjual</div>
                </li>
                </ul>
            </div>

            <div id="cateForm" class="menuCate">
                <div class="element-title flex">
                    <h3>Tambah Kategori</h3>
                    <button id="cateSwitch" class="btn-primary">Tambah Menu</button>
                </div>

                <div class="box">
                    <form action="{{ route('admin.tambahKategori') }}" method="post">
                        @csrf
                        <div class="flex align-center gap15">
                            <input type="text" name="nama_kategori" id="" placeholder="Nama Kategori">
                            <input type="submit" name="" id="" class="btn-primary" value="Tambah">
                        </div>
                    </form>
                </div>
            </div>


            <div id="menuForm" class="menuForm on">
                <div class="element-title flex">
                    <h3>Tambah Menu</h3>
                    <button id="menuSwitch" class="btn-primary">Tambah Kategori</button>
                </div>

                <div class="box">
                    <form action="{{ route('admin.tambahMenu') }}" method="post">
                        @csrf
                        <div class="flex align-center gap15">
                            <input type="text" name="nama_menu" id="" placeholder="Nama Menu">
                            <input type="number" name="harga" id="" placeholder="Harga Menu">
                        </div>

                        <div class="flex align-center gap15" style="margin: 10px 0px;">
                            <input type="number" name="stok" id="" placeholder="stok">
                            <select name="kategori_id" id="" class="btn-primary">
                                <option value="">-- Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>

                            <label for="foto" class="btn-primary text-small"><i class="ri-image-add-line text-medium text-white"></i> Pilih gambar</label>
                            <input type="file" name="foto" id="foto" class="file">
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
                <table>


                    @if ($menus->isEmpty())
                        <tr>
                            <p class="text-center">Belum ada data menu</p>
                        </tr>
                    @else
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Penjualan</th>
                            <th>Aksi</th>
                        </tr>

                        @php
                            $no = 1;
                        @endphp

                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $menu->nama_menu }}</td>
                                <td>{{ 'Rp. ' . number_format($menu->harga, 0, ',', '.') }}</td>
                                <td>{{ $menu->stok }}</td>
                                <td>Penjualan</td>
                                <td>Aksi</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>

    </div>

@endsection
