@extends('layouts.main')

@section('title', 'ohayoy-meja')

@section('content')

    <div class="content">


        <div class="element-title">
            <h3>Data Meja</h3>
        </div>

        <div class="container-w2">
            <div class="">
                <div class="element-title flex">
                    <h3>Tambah Meja</h3>
                </div>

                <div class="box">
                    <form action="{{ route('admin.tambahMeja') }}" method="post">
                        @csrf
                        <div class="flex align-center gap15">
                            <input type="text" name="nama_meja" id="" placeholder="Nama Meja" required>
                            <input type="text" name="password" id="" placeholder="Password" value="password123">
                        </div>
                        <br>
                        <div class="flex align-center gap15">
                            <select name="role_id" id="" class="btn-primary" required>
                                <option value="{{ $default->id }}">{{ $default->nama_role }}</option>
                                @foreach ($role as $r)
                                    <option value="{{ $r->id }}">{{ $r->nama_role }}</option>
                                @endforeach
                            </select>
                            <input type="submit" name="" id="" class="btn-primary" value="Tambah">
                        </div>
                    </form>
                </div>
            </div>

            <div class="">
                <div class="element-title flex">
                    <h3>Generate QR Code</h3>
                </div>
                <div class="box">
                    <form action="{{ route('admin.buatUrl') }}" method="post">
                        @csrf
                        <input type="text" name="url" id="" placeholder="contoh : https://example.com">
                        <br>
                        <input type="submit" name="" id="" class="btn-primary" value="Generate QR Code">
                    </form>
                </div>
            </div>

        </div>


        <div class="element-title">
            <h3>Tabel Meja</h3>
        </div>

        <div class="container-w1">

            <div class="table-container">
                <table>

                    @if (!$qrcode)
                        <tr>
                            <p class="text-center">Belum ada data meja</p>
                        </tr>
                    @else
                        <tr>
                            <th>No</th>
                            <th>Nama Meja</th>
                            <th>Url</th>
                            <th>Kode</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                        @php
                            $no = 1;
                        @endphp

                        @foreach ($qrcode as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data['meja']->nama_meja }}</td>

                                @if (!$data['url'])
                                    <td>url kosong</td>
                                    <td>qr code kosong ( tidak ada url )</td>
                                @else
                                    <td><a href="{{ $data['url'] }}" class="link">{{ $data['url'] }}</a></td>
                                    <td>{{ $data['qr'] }}</td>
                                @endif
                                <td>{{ $data['meja']->status }}</td>
                                <td>
                                    <div class="flex align-center gap20">
                                        <button class="btn-primary" onclick="print()">Print</button>
                                        <form action="{{ route('admin.hapusMeja', $data['meja']->id) }}" method="post"
                                            onclick="return confirm('Yakin ingin menghapus meja ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" name="" id="" class="btn-red"
                                                value="Hapus">
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
