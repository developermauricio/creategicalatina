<?php

namespace App\Http\Controllers\Backend\Provider;

use App\Http\Controllers\Controller;
use App\Model\Company;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index(){
        return view('backend.pages.provider.provider');
    }

    public function getDatableProvider(){
        $getCompaniesProvider = Company::getCompanyType(2);
        return datatables()->of($getCompaniesProvider)->toJson();
    }
}
