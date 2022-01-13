<?php

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Controller;
use App\Model\TypeProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectSetupController extends Controller
{
    public function index()
    {
        return view('backend.pages.project.project-setup');
    }

    public function getDataTypeProject()
    {
        $typeProject = TypeProject::all();
        return response()->json(['data' => $typeProject]);
    }

    public function getDataTypeProjectInfo($id)
    {
        $typeProject = TypeProject::where('id', $id)->with('team.user')->first();
        return response()->json(['data' => $typeProject]);
    }

    public function saveDataTypeProject(Request $request)
    {
        $idTypeProject = $request->id;
        $titleEs = $request->titleEs;
        $titleEn = $request->titleEn;
        $descriptionEs = $request->descriptionEs;
        $descriptionEn = $request->descriptionEn;

        $saveProjectTranslate = TypeProject::find($idTypeProject);

        $saveProjectTranslate->setTranslation("name", 'es', $titleEs);
        $saveProjectTranslate->setTranslation("name", 'en', $titleEn);

        $saveProjectTranslate->setTranslation("description", 'es', $descriptionEs);
        $saveProjectTranslate->setTranslation("description", 'en', $descriptionEn);
        $saveProjectTranslate->save();

    }

    public function uploadImageTypeProject(Request $request){
        $archive = $request->file('image');
        $archiveExtension = $archive->getClientOriginalExtension();
        $ramdon = Str::random(10);
        $nameArchive =  $ramdon . '-' . strtolower($archive->getClientOriginalName());
        $path = Storage::disk('public')->put('/typeProject/' . $nameArchive, file_get_contents($archive));
        $urlFinal = '/storage/typeProject/' . $nameArchive;
        return response()->json(['data' => $urlFinal, 'extension' => $archiveExtension]);
    }

    public function removedImageTypeProject(Request $request){
        $pathArchive = $request->get('image');
        $partes_ruta = pathinfo($pathArchive);
        Storage::delete('typeProject/' . $partes_ruta['basename']);

        response()->json(['200' => 'Se elimino correctamente']);
    }

    public function saveImageTypeProject(Request $request){
        $urlImage = $request->get('image');
        $id = $request->get('id');
        TypeProject::where('id', $id)->update([
           'picture' =>  $urlImage
        ]);
        return response()->json('Se guardo correctamente');
    }

    public function saveTeamTypeProject(Request $request){
        $team = json_decode($request->get('team'));
        $idTypeProject = $request->get('typeProject');
        $typeProject = TypeProject::find($idTypeProject);
        $array = [];
        foreach ($team as $teams){
           array_push($array, $teams->id);
        }
        $typeProject->team()->sync($array);
    }
}
