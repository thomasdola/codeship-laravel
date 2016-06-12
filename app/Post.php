<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    public function like()
    {
        $this->likes()->create(['user_id' => Auth::user()->id]);
    }

    public function unlike()
    {
        $this->likes()->where('user_id', Auth::user()->id)->delete();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
