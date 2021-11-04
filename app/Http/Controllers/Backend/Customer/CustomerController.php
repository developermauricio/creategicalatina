<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Model\Company;
use App\Model\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        return view('backend.pages.customer.all-customers');
    }
    public function getDatableCustomers(){
//        $getCompanies = Company::getCompanyType(1);
//        $customer = Customer::with('typeEntity')->get();
//        $getCustomers =$customer->customer;

        $customer = Customer::with('typeEntity', 'company.city', 'company.country', 'position', 'user.city', 'user.country', 'companyCategory')->get();
        return datatables()->of($customer)->toJson();
    }

    public function getDataCustomer($id){
        $customer = Customer::where('id', $id)->withCount('projects')->with('user.country', 'user.city', 'typeEntity', 'companyCategory', 'company')->first();
        return response()->json(['data' => $customer]);
    }
    public function getDataCompany($id){
        $company = Company::where('id', $id)->withCount('project')->with('category', 'city', 'country', 'managerCustomer.user')->first();

//        $company = Company::find($id)->project()->where('project_id', 32)->get();
        return response()->json(['data' => $company]);
    }
}
