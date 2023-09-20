<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function visitorLikesIt()
    {
        $ip = $_SERVER['REMOTE_ADDR'];

        $like = Like::where([
            ['story_id', $this->id],
            ['ip', $ip]
        ])->first();

        return (bool)$like;
    }
}
