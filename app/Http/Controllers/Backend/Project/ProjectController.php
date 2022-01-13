<?php

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(){
        return view('backend.pages.project.projects');
    }

    public function getDatatableProjects()
    {
        $projects = Project::with('user', 'typeProject', 'project_categories', 'customer.user')->get();
        return datatables()->of($projects)->toJson();
    }

    public function countStateProject(){
        $countRevisionProject = Project::where('state', 1)->count();
        $countBorradorProject = Project::where('state', 2)->count();
        $countAprobadoProject = Project::where('state', 3)->count();
        $countEnDesarrolloProject = Project::where('state', 4)->count();
        $countRechazadoProject = Project::where('state', 5)->count();
        $countFinalizadoProject = Project::where('state', 6)->count();
        return response()->json([
            'revision' => $countRevisionProject,
            'borrador' => $countBorradorProject,
            'aprobado' => $countAprobadoProject,
            'desarrollo' => $countEnDesarrolloProject,
            'rechazado' => $countRechazadoProject,
            'finalizado' => $countFinalizadoProject,
        ]);
    }

    public function getDataProject($id){
        $project = Project::where('id', $id)->with('typeProject', 'project_categories')->first();
        return response()->json(['data' => $project]);
    }
    public function getProjects(){
        $project = Project::all();
        return response()->json(['data' => $project]);
    }

    public function getDataProjectPurchase($id){
        $project = Project::where('id', $id)->with('customer.user', 'customer.companyCategory', 'company.category', 'typeProject', 'project_categories')->first();
        return response()->json(['data' => $project ]);
    }

    public function getDataCustomer(){
        $dataDbCustomer = Customer::with('user.country','user.city', 'companyCategory', 'typeEntity','company.category', 'company.country', 'company.city')->get();

        $arrayData = [];
        foreach ($dataDbCustomer as $data){
            if (count($data->company) > 0){
                $dataCompany = $data->company;
                foreach ($dataCompany as $dataCom){
                    array_push($arrayData, (object)[
                        'id' => $dataCom->id,
                        'name' => $dataCom->name,
                        'picture' => $dataCom->picture,
                        'type_customer' => $data->typeEntity,
                        'id_manager' => $data->id,
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
                    'picture' => $data->user->picture,
                    'id_manager' => null,
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

        return response()->json(['data' => $sorted->values()->all()]);

    }
}
