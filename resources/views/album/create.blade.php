@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Album') }}</div>

                <div class="card-body">
                    <album></album>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
