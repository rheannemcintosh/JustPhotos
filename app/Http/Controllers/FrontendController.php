<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;

class FrontendController extends Controller
{
    public function index ()
    {
        $albums = Album::latest()->paginate(50);

        return view('home', compact('albums'));
    }
}
