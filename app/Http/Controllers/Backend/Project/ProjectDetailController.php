<?php

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Controller;
use App\Model\Answer;
use App\Model\Brief;
use App\Model\Project;
use Illuminate\Http\Request;

class ProjectDetailController extends Controller
{
    public function index(string $locale, Project $project){
        $project = Project::where('id', $project->id)->with('project_categories', 'typeProject', 'customer.position', 'customer.companyCategory','customer.user.country', 'customer.user.city')->first();
        return view('backend.pages.project.project-detail', compact('project'));
//        return $project;
    }

    public function getAnswerBrief($id, $typeProject){
        $brief = Brief::where('type_project_id', $typeProject)->first();
        $answer = Answer::where('project_id', $id)->with('question')->get();
        return response()->json([
            'brief' => $brief,
            'answer' => $answer
        ]);
    }
}
