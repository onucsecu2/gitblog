<?php

namespace Onu\Gitblog\Models;

use Illuminate\Database\Eloquent\Model;
use Onu\Gitblog\Models\Post;

class SavedArticle extends Model
{
    protected $fillable = [
        'post_id','user_id',
    ];
    public function post() {
        return $this->belongsTo(Post::class,'post_id','id');
    }
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
