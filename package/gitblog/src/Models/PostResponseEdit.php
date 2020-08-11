<?php

namespace Onu\Gitblog\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PostResponseEdit extends Model
{
    protected $fillable = [
        'post_id','user_id','start', 'end','body','ref'
    ];
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function post() {
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
