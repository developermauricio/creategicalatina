<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    const REVISION = 1;
    const BORRADOR = 2;
    const APPROVED = 3;
    const DEVELOPMENT = 4;
    const REJECTED = 5;
    const FINALIZED = 6;
    protected $fillable = ['name', 'picture', 'user_id', 'type_project_id', 'slug', 'observations'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function project_categories(){
        return $this->belongsToMany(ProjectCategory::class, 'categories_projects', 'project_id', 'categories_project_id');
    }
    public function customer(){
        return $this->belongsToMany(Customer::class, 'customer_projects', 'project_id', 'customer_id');
    }
    public function company(){
        return $this->belongsToMany(Company::class, 'companies_projects', 'project_id', 'company_id');
    }
    public function typeProject(){
        return $this->belongsTo(TypeProject::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

}
