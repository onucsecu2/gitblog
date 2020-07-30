<?php

namespace Onu\Gitblog\Models;
use Illuminate\Database\Eloquent\Model;


class SecondaryContribution extends Model
{
    protected $fillable = [
        'contribution_id', 'contribution_for_id',
    ];
    public function contribution() {
        return $this->belongsTo(Contribution::class,'contribution_id','id');
    }
    public function contributionFor() {
        return $this->belongsTo(Contribution::class,'contribution_for_id','id');
    }
}
