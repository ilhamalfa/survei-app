@extends('layouts.template')

@section('main')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profil Unit</h1>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col">
        <div class="card">
            <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">&nbsp</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>
            <div class="card-body">
                @if (Auth::user()->role != 'admin' && Auth::user()->unit == NULL)
                    <form action="{{ url('profil-unit/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Foto Kepala Unit</label>
                            <input type="file" name="foto_kepala_unit" class="form-control @error('foto_kepala_unit') is-invalid @enderror" value="{{ old('foto_kepala_unit') }}">
                            @error('foto_kepala_unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Unit</label>
                            <input type="text" name="nama_unit" class="form-control @error('nama_unit') is-invalid @enderror" placeholder="Masukkan Nama Unit" value="{{ old('nama_unit') }}">
                            @error('nama_unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon Unit</label>
                            <input type="number" name="nomor_telp_unit" class="form-control @error('nomor_telp_unit') is-invalid @enderror" placeholder="Masukkan Nomor Telepon Unit" value="{{ old('nomor_telp_unit') }}">
                            @error('nomor_telp_unit')
                                <span class="invalid-feedback" role="alert">