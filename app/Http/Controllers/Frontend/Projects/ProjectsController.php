<?php

namespace App\Http\Controllers\Frontend\Projects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(){
        return view('frontend.pages.projects.projects');
    }
    public function indexNewProject(){
        return view('frontend.pages.projects.new-project');
    }
}
