<?php
namespace Onu\Gitblog\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $fillable = [
        'user_id', 'body','status',
    ];
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function primaryContribution() {
        return $this->hasOne(PrimaryContribution::class,'contribution_id','id');
    }
}
