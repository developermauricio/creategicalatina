<?php

namespace App;

use App\Model\City;
use App\Model\Country;
use App\Model\Customer;
use App\Model\IdentificationType;
use App\Model\Manager;
use App\Model\Provider;
use App\Model\Team;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;
    const ACTIVE = 1;
    const INACTIVE = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function customer(){
        return $this->hasOne(Customer::class, 'user_id');
    }

    public function team(){
        return $this->hasOne(Team::class, 'user_id');
    }

    public function provider(){
        return $this->hasOne(Provider::class, 'user_id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }


    public function identificationType(){
        return $this->belongsTo(IdentificationType::class, 'identification_type_id');
    }

}
