<?php

namespace Onu\Gitblog\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Onu\Gitblog\Models\Post;

class RequestContribution extends Model
{
    protected $fillable = [
        'userId', 'body','postId',
    ];
    public function user() {
        return $this->belongsTo(User::class,'userId','id');
    }
    public function post() {
        return $this->belongsTo(Post::class,'postId','id');
    }
}
