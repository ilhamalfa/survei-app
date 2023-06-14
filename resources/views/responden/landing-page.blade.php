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
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ranking dan Rekapitulasi perhitungan IKM seluruh Unit</h6>
            </div>
            <div class="card-body">
                @foreach ($sorted_rankings as $ranking)
                <h4 class="small font-weight-bold">{{ $loop->iteration . '. ' . $ranking['unit'] }} <span
                    class="float-right">{{ number_format($ranking['ikm'], 2) }}</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $ranking['ikm'] . '%' }}"
                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

@endsection