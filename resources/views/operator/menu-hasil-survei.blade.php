@extends('layouts.template')

@section('main')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->


<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rincian nilai tiap komponen Survei masing-masing Unit</h6>
            </div>
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th colspan="11">Nilai Unsur Pelayanan</th>
                        </tr>
                        <tr>
                            <th>No Responden</th>
                            @for ($i = 1; $i <= 9; $i++)
                            <th>{{ 'U'.$i }}</th>
                            @endfor
                            <th rowspan="5"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jawabans as $jawaban)
                        <tr>
                            <th>{{ "R" . $loop->iteration }}</th>
                            @for ($i = 0; $i < 9; $i++)
                            <td>{{ number_format($jawaban[$i], 2) }}</td>
                            @endfor
                            <td></td>
                        </tr>
                        @endforeach
                        <tr>
                            <th>Jumlah Nilai</th>
                            @foreach ($jumlahNilai as $nilai)
                            <td>{{ number_format($nilai, 2) }}</td>
                            @endforeach
                            <td></td>
                        </tr>
                        <tr>
                            <th>NRR</th>
                            @foreach ($NRRs as $nilai)
                            <td>{{ number_format($nilai, 2) }}</td>
                            @endforeach
                            <td></td>
                        </tr>
                        <tr>
                            <th>NRR Tertimbang</th>
                            @foreach ($NRR_Tertimbang as $nilai)
                            <td>{{ number_format($nilai, 2) }}</td>
                            @endforeach
                            <td>{{ number_format($jml_NRR, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="10">IKM Unit Pelayanan</th>
                            <th>{{ number_format($jml_NRR * 25, 2) }}</th>
                        </tr>
                        <tr>
                            <th colspan="10">Mutu Pelayanan</th>
                            <th>{{ $mutu }}</th>
                        </tr>
                        <tr>
                            <th colspan="10">Kinerja Unit Pelayanan</th>
                            <th>{{ $kinerja }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection