<?php

namespace Onu\Gitblog\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserVote extends Model
{
    protected $fillable = [
        'user_id', 'post_id',
    ];
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function post() {
        return $this->hasOne(Post::class,'post_id','id');
    }
}
