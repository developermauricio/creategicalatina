<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    const ACTIVE = 1;
    const INACTIVE = 2;
    protected $fillable = ['name', 'picture', 'user_id', 'type_project_id', 'slug', 'observations'];
    public function project_categories(){
        return $this->belongsToMany(ProjectCategory::class, 'categories_projects', 'project_id', 'categories_project_id');
    }
    public function customer(){
        return $this->belongsToMany(Customer::class, 'customer_projects', 'project_id', 'customer_id');
    }
    public function typeProject(){
        return $this->belongsTo(TypeProject::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
