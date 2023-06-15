@extends('layouts.template')

@section('main')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan Bulanan unit {{ $unit->nama_unit }}</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->

<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Hasil Analisis</h6>
            </div>
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Unsur Pelayanan</th>
                            @foreach ($bulans as $bulan)
                            <th>{{ $bulan }}</th>
                            @endforeach
                            <th>Rata-rata</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unsurs as $unsur)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $unsur->unsur_skm }}</th>
                                @for ($i = 1; $i <= 12; $i++)
                                <td>{{ number_format($hasil_perbulan[$i][$loop->iteration - 1], 2) }}</td>
                                @endfor
                                <td>{{ number_format($jml_perbulan[$loop->iteration - 1], 2) }}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <th colspan="2">Nilai SKM Unit Layanan</th>
                                @foreach ($skm_units as $skm_unit)
                                <th>{{ number_format($skm_unit, 2) }}</th>
                                @endforeach
                                <th>{{ number_format($total_skm, 2)}}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Nilai SKM</th>
                                @foreach ($nilai_skm as $skm)
                                <th>{{ number_format($skm, 2) }}</th>
                                @endforeach
                                <th>{{ number_format($total_nilai_skm, 2)}}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Jumlah Responden</th>
                                @foreach ($jumlah_responden as $responden)
                                <th>{{ $responden }}</th>
                                @endforeach
                                <th>{{  $total_responden }}</th>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection