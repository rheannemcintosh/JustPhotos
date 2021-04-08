<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowerController extends Controller
{
    public function follow (Request $request)
    {
        $followerId = User::find(auth()->user()->id);
        $followingId = User::find($request->userId);
        $followerId->following()->toggle($followingId);

        return redirect()->back();
    }
}
