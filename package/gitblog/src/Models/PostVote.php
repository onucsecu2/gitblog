<?php

namespace Onu\Gitblog\Models;

use Illuminate\Database\Eloquent\Model;

class PostVote extends Model
{
    protected $fillable = [
        'post_id','vote',
    ];
    public function post() {
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
