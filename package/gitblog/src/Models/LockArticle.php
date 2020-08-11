<?php

namespace Onu\Gitblog\Models;

use Illuminate\Database\Eloquent\Model;
use Onu\Gitblog\Models\Post;

class LockArticle extends Model
{
    protected $fillable = [
        'post_id',
    ];
    public function post() {
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
