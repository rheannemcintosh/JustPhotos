<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;

class FollowerController extends Controller
{
    public function follow (Request $request)
    {
        $followerId = User::find(auth()->user()->id);
        $followingId = User::find($request->userId);
        $followerId->following()->toggle($followingId);

        return redirect()->back();
    }

    public function profile ()
    {
        $followings = Follower::where('follower_id', auth()->user()->id)->get();
        foreach ($followings as $following) {
            $userId = $following->userfollow->id;
            $follows = (new User)->amIFollowing($userId);
        }
        return view('profile', compact('userId', 'follows', 'followings'));
    }
}
