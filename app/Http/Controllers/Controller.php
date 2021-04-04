<?php

namespace App\Http\Controllers;

use App\Model\ProjectCategory;
use App\Model\TypeProject;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function setLanguage (string $language) {
//        dd(session('language'));
        setLanguageSession($language);
//
//        if (!auth()->check()) {
//            return back();
//        }

        $segments = str_replace(url('/'), '', url()->previous());
        $segments = array_filter(explode('/', $segments));
        array_shift($segments);
        array_unshift($segments, $language);
        return redirect()->to(implode('/', $segments));
    }

    public function sessionChangeTheme(Request $request, $value){
        $request->session()->put('theme', $value);
    }

    public function sessionChangeSidebarBackend(Request $request, $value){
        $request->session()->put('sidebarMenuBackend', $value);
    }

    public function sessionSaveTour(Request $request){
        $request->session()->put('sessionTourRegisterProject', '1');
    }

    public function getTypeProject()
    {
        $getTypeProject = TypeProject::all();
        return response()->json(['data' => $getTypeProject]);
    }

    public function getCategoriesProject($id){
        $getCategoriesProjects = ProjectCategory::where('type_project_id', $id)->get();
        return response()->json(['data' => $getCategoriesProjects]);
    }
}
