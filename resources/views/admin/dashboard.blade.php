@extends('layouts.main')

@section('title', 'admin-dashboard')

@section('content')

    <section>
        <div class="grid2 gap15">
            <div class="box">
                <h4 class="title">Statistik Harian</h4>

                <div class="list">
                    <div class="item">
                        <p>Total Penjualan Hari Ini</p>
                        <p>Rp. 3.000.000,00</p>
                    </div>
                    <div class="item">
                        <p>Total Transaksi Hari Ini</p>
                        <p>60 Transaksi</p>
                    </div>

                </div>
            </div>

            <div class="box">
                <h4 class="title">Menu Terlaris</h4>
                <div class="list">
                    <div class="item">
                        <p>1</p>
                        <p>Martabak</p>
                        <p>500 Penjualan</p>
                    </div>

                    <div class="item">
                        <p>2</p>
                        <p>Kopi Kapucino</p>
                        <p>400 Penjualan</p>
                    </div>

                    <div class="item">
                        <p>3</p>
                        <p>Tiramisu cake</p>
                        <p>380 Penjualan</p>
                    </div>

                    <div class="item">
                        <p>4</p>
                        <p>CheeseCake</p>
                        <p>350 Penjualan</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="">
            <div class="box">
                <h4>Tren Penjualan</h4>
            </div>
        </div>

        <div class="">
            <div class="box">
                <h4 class="title">Transaksi Terbaru</h4>

                <table class="table1">
                    <tr>
                        <th>Waktu</th>
                        <th>Kasir</th>
                        <th>Total</th>
                    </tr>

                    <tr>
                        <td>09.55</td>
                        <td>Usman</td>
                        <td>Rp. 38.000,00</td>
                    </tr>

                    <tr>
                        <td>09.30</td>
                        <td>Usman</td>
                        <td>Rp. 30.000,00</td>
                    </tr>

                    <tr>
                        <td>09.25</td>
                        <td>Usman</td>
                        <td>Rp. 35.000,00</td>
                    </tr>

                    <tr>
                        <td>09.23</td>
                        <td>Usman</td>
                        <td>Rp. 40.000,00</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="">
            <div class="box">
                <h4 class="title">Pengumuman</h4>
                <div class="list">
                    <div class="item">
                        <p>Stok Hampir Habis</p>
                        <p>Kopi Kapucino</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
