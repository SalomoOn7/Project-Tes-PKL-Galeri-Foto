<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    public function like() {
        return $this->hasMany(Like::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
