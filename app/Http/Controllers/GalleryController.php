<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class GalleryController extends Controller
{
    public function create(){
        return view('image.create');
    }

    public function upload(Request $request){
        $this->validate($request, [
            'files' => 'required',
            'files.*' => 'mimes:png, jpeg, jpg'
        ]);

        foreach ($request->file('files') as $file) {
            $name = $file->hashName();
            $file->move(public_path().'/images/',$name);

            $file = new Image;
            $file->album_id = $request->album_id;
            $file->image = $name;
            $file->save();
        }
        return response()->json(['success' => 'Your images have been uploaded']);
    }
}
