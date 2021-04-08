@extends('layouts.app')

@section('content')
<div class="container">
    
    <img src="{{ asset('banner') }}/banner.jpg" style="width: 100%;">

    @if(auth()->user()->id != $userId)
        <follower user-id="{{ $userId }}" follows="{{ $follows }}"></follower>
    @endif

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

</div>
@endsection
