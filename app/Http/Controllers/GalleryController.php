<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Album;

class GalleryController extends Controller
{
    public function create($album_id){
        $albumBelongsToUser = Album::where('user_id', auth()->user()->id)->where('id', $album_id)->exists();

        if ($albumBelongsToUser) {
            session()->put('id', $album_id);
            return view('image.create', compact('album_id'));
        } else {
            return redirect()->back();
        }
        
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

    public function images()
    {
        return Image::where('album_id', session()->get('id'))->get();
    }

    public function destroy($id)
    {
        $image = Image::find($id);
        
        return $image->delete();
    }
}
