<?php

namespace App\Http\Controllers\Backend\Team;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamCreateController extends Controller
{
    public function index(){
        return view('backend.pages.team.create-teams');
    }

    public function uploadArchiveTeam(Request $request){
        $nameCompany = $request->input('nameTeam');
        $uuid = $request->input('nameId');
        $archive = $request->file('archive');
        $archiveExtension = $archive->getClientOriginalExtension();
        $ramdon = Str::random(10);
        $nameArchive = strtolower($nameCompany) . '-' . $ramdon . '-' . strtolower($archive->getClientOriginalName());
        $path = Storage::disk('public')->put('/archives/' . $nameArchive, file_get_contents($archive));
        $urlFinal = '/storage/archives/' . $nameArchive;
        return response()->json(['data' => $urlFinal, 'uuid' => $uuid, 'extension' => $archiveExtension]);
    }
    public function removedArchiveTeam(Request $request){
        $pathArchive = $request->get('archiveTeam');
        $partes_ruta = pathinfo($pathArchive);
        Storage::delete('archives/' . $partes_ruta['basename']);
        dd($pathArchive);
    }
}
