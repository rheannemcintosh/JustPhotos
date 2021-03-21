<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Album;

class AlbumController extends Controller
{
    public function create(){
        return view('album.create');
    }

    public function store(Request $request){
        $imageName = $request->image->hashName();
        $request->image->move(public_path('album'), $imageName);
        $album = Album::create([
            'name'        => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'slug'        => Str::slug($request->name),
            'user_id'     => auth()->user()->id,
            'image'       => $imageName
        ]);

        $id = $album->id;
        return response()->json(['id' => $id]);
    }
}
