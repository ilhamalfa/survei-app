@extends('layouts.template')

@section('main')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Seluruh Responden</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jml_responden . ' Orang' }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Jumlah Unit</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jml_unit . ' Unit' }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Layanan
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $jml_layanan . ' Layanan' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    {{-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

@if (Auth::user()->role == 'admin')
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rincian nilai tiap komponen Survei masing-masing Unit</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Unit</th>
                                <th>NRR U1</th>
                                <th>NRR U2</th>
                                <th>NRR U3</th>
                                <th>NRR U4</th>
                                <th>NRR U5</th>
                                <th>NRR U6</th>
                                <th>NRR U7</th>
                                <th>NRR U8</th>
                                <th>NRR U9</th>
                                <th>Jumlah NRR</th>
                                <th>IKM</th>
                                <th>Mutu Pelayanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sorted_rankings as $ranking)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $ranking['unit'] }}</th>
                                    @for ($i = 0; $i < 9; $i++)
                                    <td>{{ number_format($ranking['NRR' . $i], 2) }}</td>
                                    @endfor
                                    <td>{{ number_format($ranking['nrr_total'], 2) }}</td>
                                    <td>{{ number_format($ranking['ikm'], 2) }}</td>
                                    <td>
                                    @if (number_format($ranking['ikm']) >= 25 && number_format($ranking['ikm']) <= 64.99 )
                                            <h6 class="font-weight-bold">D</h6>  
                                        @elseif (number_format($ranking['ikm']) >= 65.00 && number_format($ranking['ikm']) <= 76.60 )
                                            <h6 class="font-weight-bold">C</h6>
                                        @elseif (number_format($ranking['ikm']) >= 76.61 && number_format($ranking['ikm']) <= 88.30 )
                                            <h6 class="font-weight-bold">B</h6>
                                        @elseif (number_format($ranking['ikm']) >= 88.31 && number_format($ranking['ikm']) <= 100.0 )
                                            <h6 class="font-weight-bold">A</h6>
                                        @elseif (number_format($ranking['ikm']) == 0)
                                            <h6 class="font-weight-bold text-secondary">Tidak Ditemukan</h6>
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
@endif


<!-- Content Row -->
<div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi jumlah responden seluruh Unit</h6>
            </div>
            <div class="card-body">
                @foreach ($sorted_respondens as $responden)
                <h4 class="small font-weight-bold">{{ $responden['unit'] . ' (' . $responden['jumlah_responden'] . ' Orang)' }} <span
                    class="float-right">{{ number_format($responden['jumlah_responden_persen'], 2) . '%' }}</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $responden['jumlah_responden_persen'] . '%' }}"
                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    <div class="col-lg-6 mb-4">

        <!-- Illustrations -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ranking dan Rekapitulasi perhitungan IKM seluruh Unit</h6>
            </div>
            <div class="card-body">
                @foreach ($sorted_rankings as $ranking)
                <h4 class="small font-weight-bold">{{ $loop->iteration . '. ' . $ranking['unit'] }} <span
                    class="float-right">{{ number_format($ranking['ikm'], 2) }}</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $ranking['ikm'] . '%' }}"
                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

@endsection