<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Customer extends Model
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

    public function projects(){
        return $this->belongsToMany(Project::class, 'customer_projects', 'customer_id', 'project_id');
    }

    public function archive(){
        return $this->morphOne(Archive::class, 'archivable');
    }

    public static function hasCompany(){
        $customer = Auth::user()->customer;
        $company = Company::where('customer_id', $customer->id)->get();
        $has = null;
        if (count($company) > 0){
            $has = true;
        }else{
            $has = false;
        }
        return $has;
    }

    public static function SetMessage($message){
        Session::put('notIsset', $message);
        Session::save();
    }
    public static function ForgetMessage(){
        Session::forget('notIsset');
        Session::save();
    }
}
