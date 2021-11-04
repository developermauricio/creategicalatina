<?php

namespace App\Http\Controllers\Backend\Provider;

use App\Http\Controllers\Controller;
use App\Model\Company;
use App\Model\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index(){
        return view('backend.pages.provider.provider');
    }

    public function getDatableProvider(){
        $getCompaniesProvider = Provider::with('typeEntity', 'company.city', 'company.country', 'position', 'user.city', 'user.country', 'companyCategory')->get();
        return datatables()->of($getCompaniesProvider)->toJson();
    }
}
