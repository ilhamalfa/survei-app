@extends('layouts.template')

@section('main')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Master Komponen</h1>
</div>

<!-- Content Row -->
<div class="row">
    {{-- Daftar Unsur --}}
    <div class="col">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Unsur</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Action :</div>
                        {{-- Modal button--}}
                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#unsurModal">
                            Tambah Unsur
                        </button>
                    </div>
                </div>
            </div>

            {{-- Modal --}}
            <div class="modal fade" id="unsurModal" tabindex="-1" aria-labelledby="unsurModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Unsur</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('master-komponen/tambah-unsur') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Unsur SKM</label>
                                    <input type="text" name="unsur_skm" class="form-control @error('unsur_skm') is-invalid @enderror">
                                    @error('unsur_skm')
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Unsur SKM</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unsurs as $unsur)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $unsur->unsur_skm }}</td>
                                <td>
                                    @if (Auth::user()->role == 'admin')
                                    {{-- Modal button--}}
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#unsurEditModal{{ $unsur->id }}">
                                        Edit Unsur
                                    </button>

                                    {{-- Modal --}}
                                    <div class="modal fade" id="unsurEditModal{{ $unsur->id }}" tabindex="-1" aria-labelledby="unsurEditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Unsur</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ url('master-komponen/update-unsur/' . $unsur->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Unsur SKM</label>
                                                            <input type="text" name="unsur_skm" class="form-control @error('unsur_skm') is-invalid @enderror" value="{{ $unsur->unsur_skm }}">
                                                            @error('unsur_skm')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Jenis Jawaban --}}
    <div class="col">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Jenis Jawaban</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Action :</div>

                        {{-- Modal button--}}
                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#jawabanModal">
                            Tambah Jenis Jawaban
                        </button>
                    </div>
                </div>
            </div>

            {{-- Modal --}}
            <div class="modal fade" id="jawabanModal" tabindex="-1" aria-labelledby="jawabanModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Jawaban</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('master-komponen/tambah-jawaban') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Jawaban</label>
                                    <input type="text" name="jenis_jawaban" class="form-control @error('jenis_jawaban') is-invalid @enderror">
                                    @error('jenis_jawaban')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label">Jawaban 1</label>
                                        <input type="text" name="jawaban[0]" class="form-control @error('jawaban[0]') is-invalid @enderror">
                                        @error('jawaban[0]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Bobot 1</label>
                                        <input type="text" name="bobot[0]" class="form-control @error('bobot[0]') is-invalid @enderror">
                                        @error('bobot[0]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label">Jawaban 2</label>
                                        <input type="text" name="jawaban[1]" class="form-control @error('jawaban[1]') is-invalid @enderror">
                                        @error('jawaban[1]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Bobot 2</label>
                                        <input type="text" name="bobot[1]" class="form-control @error('bobot[1]') is-invalid @enderror">
                                        @error('bobot[1]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label">Jawaban 3</label>
                                        <input type="text" name="jawaban[2]" class="form-control @error('jawaban[2]') is-invalid @enderror">
                                        @error('jawaban[2]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Bobot 3</label>
                                        <input type="text" name="bobot[2]" class="form-control @error('bobot[2]') is-invalid @enderror">
                                        @error('bobot[2]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label">Jawaban 4</label>
                                        <input type="text" name="jawaban[3]" class="form-control @error('jawaban[3]') is-invalid @enderror">
                                        @error('jawaban[3]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Bobot 4</label>
                                        <input type="text" name="bobot[3]" class="form-control @error('bobot[3]') is-invalid @enderror">
                                        @error('bobot[3]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Jenis Jawaban</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jawabans as $jawaban)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jawaban->jenis_jawaban }}</td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#daftarjawabanModal{{ $loop->iteration }}">Lihat Jawaban</button>
                                
                                    {{-- Modal --}}
                                    <div class="modal fade" id="daftarjawabanModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="daftarjawabanModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Daftar {{ $jawaban->jenis_jawaban }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Jawaban</th>
                                                                <th>Bobot</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $gandas = \App\Models\JawabanGanda::where('jawaban_id', $jawaban->id)->get(); ?>
                                                            @foreach ($gandas as $ganda)
                                                            <tr>
                                                                <th>{{ $loop->iteration }}</th>
                                                                <th>{{ $ganda->jawaban }}</th>
                                                                <th>{{ $ganda->bobot }}</th>
                                                                <th></th>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">submit</button>
                                                </div>
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

<div class="row mt-3">
    {{-- Jenis Jawaban --}}
    <div class="col">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Soal Kuisioner</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Action :</div>
                        {{-- Modal button--}}
                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#kuisionerModal">
                            Tambah Layanan
                        </button>
                    </div>
                </div>
            </div>

            {{-- Modal Kuisioner --}}
            <div class="modal fade" id="kuisionerModal" tabindex="-1" aria-labelledby="kuisionerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Soal Kuisioner</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('master-komponen/tambah-soal-kuisioner') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Soal Kuisioner</label>
                                    <input type="text" name="pertanyaan" class="form-control @error('pertanyaan') is-invalid @enderror">
                                    @error('pertanyaan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Unsur</label>
                                    <select class="form-control @error('unsur_id') is-invalid @enderror" name="unsur_id">
                                        <option value="">-- Pilih Unsur --</option></option>
                                        @foreach ($unsurs as $unsur)
                                        <option value="{{ $unsur->id }}">{{ $unsur->unsur_skm }}</option>
                                        @endforeach
                                    </select>
                                    @error('unsur_id')
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pertanyaan</th>
                                <th>Unsur</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kuisioners as $kuisioner)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kuisioner->pertanyaan }}</td>
                                <td>{{ $kuisioner->unsur->unsur_skm }}</td>
                                <td>
                                    <button class="btn btn-warning">Edit</button>
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
@endsection
