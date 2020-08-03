<?php
namespace Onu\Gitblog\Models;

use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    protected $fillable = [
        'post_id','views',
    ];
    public function post() {
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
