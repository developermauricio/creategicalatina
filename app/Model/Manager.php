<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function position(){
        return $this->belongsTo(PositionManager::class);
    }
}
