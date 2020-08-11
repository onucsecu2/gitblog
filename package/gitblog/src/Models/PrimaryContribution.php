<?php

namespace Onu\Gitblog\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PrimaryContribution extends Model
{
    protected $fillable = [
        'post_id', 'contribution_id',
    ];
    public function contribution() {
        return $this->belongsTo(Contribution::class,'contribution_id','id');
    }
    public function post() {
        return $this->belongsTo(Post::class,'post_id','id');
    }
//    public function user()
//    {
//        return $this->contribution();
//    }
}
