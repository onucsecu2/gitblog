<?php

namespace Onu\Gitblog\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PostResponseEdit extends Model
{
    protected $fillable = [
        'postId','userId','start', 'end','body','ref'
    ];
    public function user() {
        return $this->belongsTo(User::class,'userId','id');
    }
    public function post() {
        return $this->belongsTo(Post::class,'postId','id');
    }
}
