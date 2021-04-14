<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    const ACTIVE = 1;
    const INACTIVE = 2;

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function category()
    {
        return $this->belongsTo(CompanyCategory::class, 'company_category_id');
    }
    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
