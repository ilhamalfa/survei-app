@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">{{ __('Ranking Unit') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
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
                                            Tidak Baik
                                        @elseif (number_format($NRR[$unit->nama_unit] * 25, 2) >= 43.76 && number_format($NRR[$unit->nama_unit] * 25, 2) <= 62.50 )
                                            Kurang Baik
                                        @elseif (number_format($NRR[$unit->nama_unit] * 25, 2) >= 62.51 && number_format($NRR[$unit->nama_unit] * 25, 2) <= 81.25 )
                                            Baik
                                        @elseif (number_format($NRR[$unit->nama_unit] * 25, 2) >= 81.26 && number_format($NRR[$unit->nama_unit] * 25, 2) <= 100.0 )
                                            Sangat Baik
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
    </div>
</div>
@endsection

{{--  --}}
