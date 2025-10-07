@extends('layouts.main')

@section('title', 'ohayoy-meja')

@section('content')

    <div class="content">

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
                        <input type="text" name="" id="" disabled
                            value="default : http://cafe_web.test/log/customer">
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
                <table class="table">

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
                            <th>Username</th>
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

                                @if ($data['meja']->status === 'terisi')
                                    <td>{{ $data['meja']->username }}</td>
                                    <td style="color: crimson; font-weight: 500;">{{ $data['meja']->status }}</td>
                                @elseif ($data['meja']->status === 'kosong')
                                    <td>kosong</td>
                                    <td style="color: var(--primary); font-weight: 500;">{{ $data['meja']->status }}</td>
                                @endif

                                <td>
                                    <div class="flex align-center flex-center gap10">
                                        <button class="btn-blue" onclick="print()">Print</button>
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

                    {{-- <div id="mejaData"></div> --}}
                </table>
            </div>

        </div>

    </div>


    {{-- <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script>
        $.ajax({
            url: '/admin/meja/data',
            method: 'GET',
            success: function(res) {
                let html = '';
                let no = 1;

                $.each(res.qrcode, function(i, data) {
                    html += `
                <table>
                <tr>
                    <th>No</th>
                    <th>Nama Meja</th>
                    <th>Url</th>
                    <th>Kode</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <tr>
                    <td>${no++}</td>
                    <td>${data.meja.nama_meja}</td>`;

                    if (!data.url) {
                        html += `
                    <td>url kosong</td>
                    <td>qr code kosong ( tidak ada url )</td>`;
                    } else {
                        html += `
                    <td><a href="${data.url}" class="link">${data.url}</a></td>
                    <td>${data.qr}</td>`;
                    }

                    if (data.meja.status === 'terisi') {
                        html += `
                    <td>${data.meja.username}</td>
                    <td style="color: crimson; font-weight: 500;">${data.meja.status}</td>`;
                    } else {
                        html += `
                    <td>kosong</td>
                    <td style="color: var(--primary); font-weight: 500;">${data.meja.status}</td>`;
                    }

                    html += `
                <td>
                    <div class="flex align-center gap20">
                        <button class="btn-primary" onclick="print()">Print</button>
                        <form action="/admin/hapus-meja/${data.meja.id}" method="post" onsubmit="return confirm('Yakin ingin menghapus meja ini?')">
                            <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" class="btn-red" value="Hapus">
                        </form>
                    </div>
                </td>
                </tr>
                </table>
                `;
                });

                $('#mejaData').html(html);
            }
        });
    </script> --}}

@endsection
