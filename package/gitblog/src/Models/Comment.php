<?php

namespace Onu\Gitblog\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body',
    ];
    public function reply() {
        return $this->hasMany(CommentReply::class,'comment_id','id');
    }


}
