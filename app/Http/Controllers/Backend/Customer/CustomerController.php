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

//        $customer = Customer::with('typeEntity', 'company.city', 'company.country', 'position', 'user.city', 'user.country', 'companyCategory')->get();
//        return datatables()->of($customer)->toJson();


        $dataDbCustomer = Customer::with('user.country','user.city', 'companyCategory', 'typeEntity','company.category', 'company.country', 'company.city')->get();

        $arrayData = [];
        foreach ($dataDbCustomer as $data){
            if (count($data->company) > 0){
                $dataCompany = $data->company;
                foreach ($dataCompany as $dataCom){
                    array_push($arrayData, (object)[
                        'id' => $dataCom->id,
                        'name' => $dataCom->name,
                        'type_customer' => $data->typeEntity,
                        'category' => $dataCom->category,
                        'email' => $dataCom->email,
                        'phone' => $dataCom->phone,
                        'country' => $dataCom->country->name,
                        'flagCountry' => $dataCom->country->flag,
                        'city' => $dataCom->city->name,
                        'state' => $dataCom->state,
                        'slug' => $dataCom->slug
                    ]);
                }

            }else{
                array_push($arrayData, (object)[
                    'id' => $data->id,
                    'name' => $data->user->name .' '.$data->user->last_name,
                    'type_customer' => $data->typeEntity,
                    'category' => $data->companyCategory,
                    'email' => $data->user->email,
                    'phone' => $data->user->phone,
                    'country' => $data->user->country->name,
                    'flagCountry' => $data->user->country->flag,
                    'city' => $data->user->city->name,
                    'state' => $data->user->state,
                    'slug' => $data->user->slug
                ]);
            }
        }
        $collection = collect($arrayData);
        $sorted = $collection->sortBy('name');

        $sorted->values()->all();

        return datatables()->of($sorted->values()->all())->toJson();

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
