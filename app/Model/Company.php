<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function managerCustomer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function project(){
        return $this->belongsToMany(Project::class, 'companies_projects', 'company_id', 'project_id');
    }

    public static function getCompany(){
        $manager = Auth::user()->manager;
        $company = Company::where('manager_id', $manager->id)->first();
        return $company;
    }

    public static function getCompanyType($type){
        $getCompanyType = Company::with('manager.user', 'city', 'country', 'companyType')->
            whereHas('companyType', function ($q) use($type){
                $q->where('company_type_id', $type);
            }
            )->get();
        return $getCompanyType;
    }


    public static function companyGetProjects(){
        $manager = Auth::user()->manager;
        $company = Company::where('manager_id', $manager->id)->first();
        $projects = Project::with('user', 'typeProject', 'project_categories')->whereHas('company', function ($q) use($company){
            $q->where('company_id', $company->id);
        })->get();
        return $projects;
    }

    public function customer(){
        return $this->morphMany(Customer::class, 'customeable', 'customer_type', 'customer_id');
    }

    public function companyType(){
        return $this->belongsToMany(CompanyType::class, 'company_company_types', 'company_id', 'company_type_id');
    }
}
