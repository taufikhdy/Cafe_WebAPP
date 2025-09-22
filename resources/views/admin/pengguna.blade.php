@extends('layouts.main')

@section('title', 'ohayo-pengguna')

@section('content')

    <div class="content">
        <div class="element-title">
            <h3>Pengguna</h3>
        </div>

        <div class="container-w2">
            <div class="">
                <div class="profile-card">
                    <div class="profile-title">
                        <h3>Profil</h3>
                    </div>

                    <div class="profile-content">
                        <img src="" alt="user photo" class="foto">

                        <div class="profile-info">
                            <div class="text-info">Nama Pengguna</div>
                            <div class="text-info text-bold">{{ Auth::User()->name }}</div>
                            <div class="text-info">Role Pengguna</div>
                            <div class="text-info text-bold">{{ Auth::user()->role->nama_role }}</div>
                            <div class="text-info"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="box">
                    <div class="">
                        <div class="profile-title">
                            <h3>Tambah Pengguna</h3>
                        </div>
                    <form action="" method="post">
                        @csrf
                            <input type="text" name="name" id="" placeholder="Nama Pengguna">

                        <div class="flex align-center gap15" style="margin: 10px 0px;">
                            <input type="text" name="password" id="" placeholder="Password">
                            <select name="role_id" id="" class="btn-primary">
                                <option value="">-- Role --</option>
                                @foreach ($role as $role)
                                <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                                @endforeach
                            </select>

                            <label for="foto" class="btn-primary text-small"><i class="ri-image-add-line text-medium text-white"></i> Foto</label>
                            <input type="file" name="foto" id="foto" class="file">
                        </div>

                        <input type="submit" class="btn-primary" value="Tambah">
                    </form>
                </div>
            </div>
        </div>

        <div class="container-w1">
            <div class="element-title">
                <h3>Pengguna Online</h3>
            </div>

            <table>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Status</th>
                <th>Role</th>
                <th>Aksi</th>
            </table>
        </div>

    </div>

@endsection
