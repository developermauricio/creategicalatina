<?php

namespace App\Http\Controllers\Backend\Team;

use App\Http\Controllers\Controller;
use App\Model\Team;
use App\Model\WorkArea;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(){
        return view('backend.pages.team.all-members-team');
    }

    public function getDatableTeam(){
        $getTeam = Team::with('user.city', 'user.country', 'teamPosition')->get();
        return datatables()->of($getTeam)->toJson();
    }

    public function getTypeWorkArea(){
        $getTypeWorkArea = WorkArea::all();
        return response()->json(['data' => $getTypeWorkArea]);
    }

    public function getListGridTeam(){
        $getListGridTeam = Team::with('user', 'teamPosition')->get();
        return response()->json(['data' => $getListGridTeam]);
    }

}
