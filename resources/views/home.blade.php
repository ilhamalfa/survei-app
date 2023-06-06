@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (Auth::user()->unit() == Null)
                        <div class="alert alert-warning" role="alert">
                            Data Unit Masih Kosong, Tolong Isi Data Unit. <a href="#" style="color:inherit">Klik Disini!</a>
                        </div>
                    @else

                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
