<?php
namespace Onu\Gitblog\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;



class Post extends Model
{
    protected $fillable = [
        'user_id','title','slug', 'body',
    ];
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function primaryContributions(){
        return $this->hasMany(PrimaryContribution::class,'post_id','id');
    }
}
