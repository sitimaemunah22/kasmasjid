@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-end">
        <div class="col-10">
            <div class="card">
                <div class="card-header">{{ __('Total : 1.000.000') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <h1>HALO</h1>

                    <img src="logomasjid.png" width="100" height="50">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection