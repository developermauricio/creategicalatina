<?php

namespace App\Http\Controllers\Frontend\Projects;

use App\Http\Controllers\Controller;
use App\Model\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function index(){
        return view('frontend.pages.projects.projects');
    }
    public function indexNewProject(){
        return view('frontend.pages.projects.new-project');
    }

    public function getDatatableProjectsCompany(){
        $projectsCompany = Company::companyGetProjects();
        return datatables()->of($projectsCompany)->toJson();
    }
}
