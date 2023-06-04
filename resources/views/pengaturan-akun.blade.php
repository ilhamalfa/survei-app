@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Pengaturan Akun') }}</div>

                <div class="card-body">
                    <!-- Start Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                        Tambah Operator Unit
                    </button>
                    <!-- End Button trigger modal -->

                    <!-- Start Modal -->
                    <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Operator Unit</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Perangkat Daerah</label>
                                            <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Perangkat Daerah">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nomor Telepon</label>
                                            <input type="number" name="nomor_telp" class="form-control" placeholder="Masukkan Nomor Telepon">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">E-mail</label>
                                            <input type="email" name="email" class="form-control" placeholder="Masukkan E-mail">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Perangkat Daerah</th>
                                <th>Nomor Telepon</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $data->name }}</th>
                                <th>{{ $data->nomor_telp }}</th>
                                <th>{{ $data->email }}</th>
                                <th>{{ $data->username }}</th>
                                <th>Aksi</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
