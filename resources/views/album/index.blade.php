@extends('layouts.app')

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <h3>Your album</h3>
        <span style="margin-left: 700px;">
            <a href="{{ route('album.create') }}">
                <button class="btn btn-primary">
                    Create New Album
                </button>
            </a>
        </span>
    </ol>
    <div clas="row">
        <div class="col-md-12">
            <index></index>
        </div>
    </div>
</div>
@endsection
