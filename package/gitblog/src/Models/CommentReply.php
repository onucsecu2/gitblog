<?php

namespace Onu\Gitblog\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $fillable = [
        'user_id','comment_id',
    ];
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function comment() {
        return $this->belongsTo(Comment::class,'comment_id','id');
    }
}
