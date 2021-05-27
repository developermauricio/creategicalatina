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
}
