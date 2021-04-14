<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Model\Company;
use Illuminate\Http\Request;

class ProfileCustomerController extends Controller
{
    public function index(string $locale, Company $company){
        $getCompany = Company::where('id', $company->id)->with('category', 'country', 'city', 'manager.user.identificationType', 'manager.position')->first();
//        return $getCompany;
        return view('backend.pages.customer.profile-customer', compact('getCompany'));
    }
}
