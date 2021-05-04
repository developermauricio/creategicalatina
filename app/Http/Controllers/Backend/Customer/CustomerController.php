<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Model\Company;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        return view('backend.pages.customer.all-customers');
    }
    public function getDatableCustomers(){
        $getCompanies = Company::getCompanyType(1);
        return datatables()->of($getCompanies)->toJson();
    }
}
