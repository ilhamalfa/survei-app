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
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $loop->iteration }}">
                                                Lihat Daftar Layanan
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Layanan Unit {{ $unit->nama_unit }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Layanan Unit</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{-- {{ dd($daftar_layanan) }} --}}
                                                            @foreach ($daftar_layanan[$unit->nama_unit] as $layanan)
                                                                <tr>

                                                                    <th>{{ $loop->iteration }}</th>
                                                                    <td>{{ $layanan }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
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