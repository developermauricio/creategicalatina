<?php

namespace App\Http\Controllers\Frontend\Companies;

use App\Http\Controllers\Controller;
use App\Model\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    public function index()
    {
        return view('frontend.pages.companies.companies');
    }

    public function companiesCustomer()
    {
        $customer = Auth::user()->customer;
        $getCompaniesCustomer = Company::where('customer_id', $customer->id)->with('category')->get();
        if ($getCompaniesCustomer) {
            return response()->json(['data' => $getCompaniesCustomer]);
        } else {
            return response()->json(['data' => 'No tiene empresas']);
        }

    }
}
