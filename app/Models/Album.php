<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category () {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function albumImages ()
    {
        return $this->hasMany(Image::class, 'album_id', 'id');
    }
 
}
