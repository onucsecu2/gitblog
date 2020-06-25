<?php
namespace Onu\Gitblog\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;



class Post extends Model
{
    protected $fillable = [
        'userId','title','slug', 'body',
    ];
    public function user() {
        return $this->belongsTo(User::class,'userId','id');
    }
}
