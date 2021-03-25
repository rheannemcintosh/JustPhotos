@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All Albums') }}</div>
                <index></index>
            </div>
        </div>
    </div>
</div>
@endsection
