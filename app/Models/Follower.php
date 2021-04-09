<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function userfollow ()
    {
        return $this->belongsTo(User::class, 'following_id', 'id');
    }
}
