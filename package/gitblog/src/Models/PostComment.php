<?php
namespace Onu\Gitblog\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $fillable = [
        'user_id','post_id','comment_id',
    ];
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function post() {
        return $this->belongsTo(Post::class,'post_id','id');
    }
    public function comment() {
        return $this->belongsTo(Comment::class,'comment_id','id');
    }

}
