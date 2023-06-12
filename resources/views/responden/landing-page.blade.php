@extends('layouts.template')

@section('main')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
    <h1 class="h3 mb-0 text-gray-800">Landing Page</h1>
</div>

<!-- Content Row -->
<div class="row mt-5">

    <div class="col-12">
        <!-- Project Card Example -->
        <div class="card shadow mb-4 mt-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Hasil IKM</h6>
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
                        @foreach ($units as $unit)
                            <tr>
                            <th>{{ $loop->iteration }}</th>
                            <th>{{ $unit->nama_unit }}</th>
                            @for ($i = 1; $i <= 9; $i++)
                                <td>{{ number_format($hasil_akhir[$unit->nama_unit][$i], 2) }}</td>
                            @endfor
                            <td>{{ number_format($NRR[$unit->nama_unit], 2) }}</td>
                            <td>{{ number_format($NRR[$unit->nama_unit] * 25, 2) }}</td>
                            <td>
                                @if (number_format($NRR[$unit->nama_unit] * 25, 2) >= 25 && number_format($NRR[$unit->nama_unit] * 25, 2) <= 43.75 )
                                    <h6 class="font-weight-bold text-danger">Tidak Baik</h6>  
                                @elseif (number_format($NRR[$unit->nama_unit] * 25, 2) >= 43.76 && number_format($NRR[$unit->nama_unit] * 25, 2) <= 62.50 )
                                    <h6 class="font-weight-bold text-warning">Kurang Baik</h6>
                                @elseif (number_format($NRR[$unit->nama_unit] * 25, 2) >= 62.51 && number_format($NRR[$unit->nama_unit] * 25, 2) <= 81.25 )
                                    <h6 class="font-weight-bold text-primary">Baik</h6>
                                @elseif (number_format($NRR[$unit->nama_unit] * 25, 2) >= 81.26 && number_format($NRR[$unit->nama_unit] * 25, 2) <= 100.0 )
                                    <h6 class="font-weight-bold text-success">Sangat Baik</h6>
                                @elseif (number_format($NRR[$unit->nama_unit] * 25, 2) == 0)
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

@endsection