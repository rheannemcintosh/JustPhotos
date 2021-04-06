@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid">
        <h1 class="display-4">
            Share Your Photos
        </h1>
        <p class="lead">
            Share your photos with others
        </p>
    </div>

    <div class="row">
        @foreach($albums as $album)
            <div class="col-lg-3">
                <div class="card">
                    <img src="{{ asset('album') }}/{{ $album->image }}" class="card-img-top">
                    <div clas="card-body">
                        <h5 class="card-title">
                        <center>{{ $album->name }}</center> 
                        </h5>
                        <center>
                            <a href="{{ route('view.album'), [$album->slug, $album->id] }}" class="btn btn-primary">View Album</a>
                        </center>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $albums->links() }}
</div>
@endsection
