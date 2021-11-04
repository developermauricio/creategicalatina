<?php

namespace App\Http\Controllers\Backend\Team;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigurationTeamController extends Controller
{
    public function index(){
        return view('backend.pages.configuration.configuration-team');
    }
}
