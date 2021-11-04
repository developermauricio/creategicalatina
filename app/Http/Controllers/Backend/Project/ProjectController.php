<?php

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Controller;
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
}
