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
            @if (Auth::user()->role != 'admin' && Auth::user()->unit == NULL)
                <div class="card-body">
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
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Unit</label>
                            <input type="email" name="email_unit" class="form-control @error('email_unit') is-invalid @enderror" placeholder="Masukkan Email Unit" value="{{ old('email_unit') }}">
                            @error('email_unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penanggung Jawab Layanan</label>
                            <input type="text" name="penanggung_jawab_layanan" class="form-control @error('penanggung_jawab_layanan') is-invalid @enderror" placeholder="Masukkan Nama Unit" value="{{ old('penanggung_jawab_layanan') }}">
                            @error('penanggung_jawab_layanan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Layanan</label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Nama Unit" value="{{ old('alamat') }}">
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            @else
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Action :</div>
                            {{-- Modal button--}}
                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#exampleModal">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Modal --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('profil-unit/update/' . $data->unit->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Foto Kepala Unit</label>
                                        <input type="file" name="foto_kepala_unit" class="form-control @error('foto_kepala_unit') is-invalid @enderror">
                                        @error('foto_kepala_unit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Unit</label>
                                        <input type="text" name="nama_unit" class="form-control @error('nama_unit') is-invalid @enderror" placeholder="Masukkan Nama Unit" value="{{ $data->unit->nama_unit }}">
                                        @error('nama_unit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Telepon Unit</label>
                                        <input type="text" name="nomor_telp_unit" class="form-control @error('nomor_telp_unit') is-invalid @enderror" placeholder="Masukkan Nama Unit" value="{{ $data->unit->nomor_telp_unit }}">
                                        @error('nomor_telp_unit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email Unit</label>
                                        <input type="text" name="email_unit" class="form-control @error('email_unit') is-invalid @enderror" placeholder="Masukkan Nama Unit" value="{{ $data->unit->email_unit }}">
                                        @error('email_unit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Penanggung Jawab Layanan</label>
                                        <input type="text" name="penanggung_jawab_layanan" class="form-control @error('penanggung_jawab_layanan') is-invalid @enderror" placeholder="Masukkan Nama Unit" value="{{ $data->unit->penanggung_jawab_layanan }}">
                                        @error('penanggung_jawab_layanan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat Layanan</label>
                                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Nama Unit" value="{{ $data->unit->alamat }}">
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ asset('storage/' . $data->unit->foto_kepala_unit) }}" alt="" class="img w-50 mx-auto d-block">
                        </div>
                        <div class="col-8">
                            <div class="mb-3">
                                <h4 class="form-label">Nama Unit : {{ $data->unit->nama_unit }}</h4>
                            </div>
                            <div class="mb-3">
                                <h4 class="form-label">Nomor Telepon Unit : {{ $data->unit->nomor_telp_unit }}</h4>
                            </div>
                            <div class="mb-3">
                                <h4 class="form-label">Email Unit : {{ $data->unit->email_unit }}</h4>
                            </div>
                            <div class="mb-3">
                                <h4 class="form-label">Penanggung jawab Layanan : {{ $data->unit->penanggung_jawab_layanan }}</h4>
                            </div>
                            <div class="mb-3">
                                <h4 class="form-label">Alamat : {{ $data->unit->alamat}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@if (Auth::user()->role != 'admin' && Auth::user()->unit != NULL)
<div class="row mt-3">
    <div class="col">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Layanan</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Action :</div>
                        {{-- Modal button--}}
                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#tambahModal">
                            Tambah Layanan
                        </button>
                    </div>
                </div>
            </div>

            {{-- Modal --}}
            <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Layanan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ 'profil-unit/layanan/store' }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Layanan</label>
                                    <input type="text" name="nama_layanan" class="form-control @error('nama_layanan') is-invalid @enderror">
                                    @error('nama_layanan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input type="text" name="unit_id" value="{{ $data->unit->id }}" hidden>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
            <div class="card-body">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Jenis Layanan</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $layanan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $layanan->nama_layanan }}</td>
                                <td>
                                    {{-- Edit --}}
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $layanan->id }}">
                                        Edit
                                    </button>

                                    {{-- Modal --}}
                                    <div class="modal fade" id="editModal{{ $layanan->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Layanan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ 'profil-unit/layanan/update/' . $layanan->id }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Jenis Layanan</label>
                                                            <input type="text" name="nama_layanan" value="{{ $layanan->nama_layanan }}" class="form-control @error('nama_layanan') is-invalid @enderror">
                                                            @error('nama_layanan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <input type="text" name="unit_id" value="{{ $data->unit->id }}" hidden>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
