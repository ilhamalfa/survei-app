@extends('layouts.template')

@section('main')
    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Unit</h6>
                </div>
            
                <div class="card-body">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Unit</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($units as $unit)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $unit->nama_unit }}</th>
                                        <th>
                                            <a href="{{ url('data-survei/laporan-kuisioner/' . $unit->id) }}" class="btn btn-primary">Laporan Responden</a>

                                            <a href="{{ url('data-survei/laporan-perbulan/' . $unit->id) }}" class="btn btn-primary">Laporan Perbulan</a>
                                        </th>
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