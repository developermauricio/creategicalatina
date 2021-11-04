<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function teamPosition(){
        return $this->belongsToMany(PositionMember::class, 'team_work_area', 'team_id', 'position_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function archive(){
        return $this->morphOne(Archive::class, 'archivable');
    }
}
