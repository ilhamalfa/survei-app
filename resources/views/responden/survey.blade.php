@extends('layouts.template')

@section('main')
        <form action="{{ 'store-responden' }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('Data Responden') }}</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama Responden" value="{{ old('nama') }}">
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Usia</label>
                                    <input type="text" name="usia" class="form-control @error('usia') is-invalid @enderror" placeholder="Masukkan Usia Responden" value="{{ old('usia') }}">
                                    @error('usia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                        <option value="">-- Pilih Jenis Kelamin --</option></option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Pekerjaan</label>
                                    <select class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan">
                                        <option value="">-- Pilih Pekerjaan --</option></option>
                                        <option value="PNS/TNI/POLRI">PNS/TNI/POLRI</option>
                                        <option value="Wiraswasta">Wiraswasta</option>
                                        <option value="Pegawai Swasta">Pegawai Swasta</option>
                                        <option value="Pegawai BUMN/BUMD">Pegawai BUMN/BUMD</option>
                                        <option value="Peneliti/Dosen">Peneliti/Dosen</option>
                                        <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    @error('pekerjaan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pendidikan</label>
                                    <select class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan">
                                        <option value="">-- Pilih Pendidikan --</option></option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="D1">D1</option>
                                        <option value="D2">D2</option>
                                        <option value="D3">D3</option>
                                        <option value="D4">D4</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                    @error('pendidikan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nomor Telp</label>
                                    <input type="number" name="nomor_telp" class="form-control @error('nomor_telp') is-invalid @enderror" placeholder="Masukkan Nomor Telepon Responden" value="{{ old('nomor_telp') }}">
                                    @error('nomor_telp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3 mb-3">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('Unit Dan Layanan') }}</h6>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Unit</label>
                            <select class="form-control @error('unit_id') is-invalid @enderror" name="unit_id" id="unit">
                                <option value="">-- Pilih Unit --</option></option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->nama_unit }}</option>
                                @endforeach
                            </select>
                            @error('unit_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Layanan</label>
                            <select id="layanan" class="form-control @error('layanan_id') is-invalid @enderror" name="layanan_id">
                                <option value="">-- Pilih layanan --</option>
                            </select>
                            @error('layanan_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-11"></div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
@endsection
