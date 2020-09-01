<?php

namespace Onu\Gitblog\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleEpisode extends Model
{
    protected $fillable = [
        'post_id','state','episode_post_id',
    ];
    public function post() {
        return $this->belongsTo(Post::class,'post_id','id');
    }
    public function episode_post() {
        return $this->belongsTo(Post::class,'episode_post_id','id');
    }
}
