<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    const ACTIVE = 1;
    const INACTIVE = 2;

    public function project_categories(){
        return $this->belongsToMany(ProjectCategory::class, 'categories_projects', 'project_id', 'categories_project_id');
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

}
