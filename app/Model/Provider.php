<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    public function typeEntity(){
        return $this->belongsTo(TypeEntity::class, 'type_entitity_id');
    }

    public function company(){
        return $this->hasMany(Company::class);
    }

    public function position(){
        return $this->belongsTo(PositionManager::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function companyCategory(){
        return $this->belongsTo(CompanyCategory::class);
    }

    public function archive(){
        return $this->morphOne(Archive::class, 'archivable');
    }
}
