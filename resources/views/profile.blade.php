@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item active">
                          <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Following</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#profilepic" role="tab" data-toggle="tab">Profile Picture</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#bgpic" role="tab" data-toggle="tab">Background Picture</a>
                        </li>
                      </ul>
                      
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="buzz">
                            @foreach($followings as $follow)
                                <p>
                                    {{ $follow->userfollow->name }}
                                    <a href="{{ route('user.album', [$follow->userfollow->id]) }}">
                                        <img src="{{ Storage::url($follow->userfollow->profilePic) }}" width="50">
                                    </a>
                                </p>
                                <p>
                                    @if(auth()->user()->id != $userId)
                                        <follower user-id="{{ $userId }}" follows="{{ $follows }}"></follower>
                                    @endif
                                </p>
                            @endforeach
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profilepic">
                            <avatar userid="{{auth()->user()->id}}"></avatar>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="bgpic">
                            <background userid="{{auth()->user()->id}}"></background>
                        </div>
                      </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
