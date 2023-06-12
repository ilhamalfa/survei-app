@extends('layouts.template')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <form action="{{ 'store-survei' }}" method="POST">
        @csrf
        <div class="col-md-12">
            <input type="text" name="responden_id" value="{{ $responden->id }}" hidden>

            <input type="text" name="layanan_id" value="{{ $layanan_id }}" hidden>

            <input type="text" name="unit_id" value="{{ $unit_id }}" hidden>

            @foreach ($datas as $data)
            <div class="card mt-3">
                <div class="card-header"><h6 class="m-0 font-weight-bold text-primary">{{ __('Pertanyaan Ke-' . $loop->iteration ) }}</h6></div>

                <div class="card-body">
                    <div class="row">

                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">{{ $data->soalKuisioner->pertanyaan }}</label>
                                {{-- <input type="text" name="soal[{{ $loop->iteration - 1 }}]" value="{{ $data->soalKuisioner->id }}"> --}}
                                <?php $answers = \App\Models\JawabanGanda::where('jawaban_id', $data->jawaban_id)->get(); ?>
                                <div class="row">
                                    @foreach ($answers as $answer)
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jawaban[{{ $loop->parent->iteration - 1 }}]" value="{{ $answer->id }}">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    {{ $answer->jawaban }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="card mt-3 mb-3">
                <div class="card-header"><h6 class="m-0 font-weight-bold text-primary">{{ __('Kritik dan Saran') }}</h6></div>

                <div class="card-body">
                    <div class="row mb-3">
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="kritik_saran" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-11"></div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
    </div>
</div>
@endsection
