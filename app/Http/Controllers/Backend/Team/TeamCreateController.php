<?php

namespace App\Http\Controllers\Backend\Team;

use App\Http\Controllers\Controller;
use App\Mail\Register\RegisterTeam;
use App\Model\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

    public function storeCreateTeam(Request $request){
        $password = Str::random(8);
        $pass = bcrypt($password);
        $archives = json_decode($request->archives);
        $country = json_decode($request->country);
        $city = json_decode($request->city);
        $positionTeam = json_decode($request->position_team);
        $typeIdentification = json_decode($request->type_identification);
        $language = json_decode($request->languageEmail);
        $ramdon = Str::random(10);
        $success = true;

        DB::beginTransaction();
        try {
            $slug = Str::slug($request->name . '-' . $request->last_name . '-' . $ramdon, '-');
            $user = new User;
            $user->name = ucwords($request->name);
            $user->last_name = ucwords($request->last_name);
            $user->email = $request->email;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->identification_type_id = $typeIdentification->id;
            $user->identification = $request->identification;
            $user->identification = $request->identification;
            $user->birthday = $request->dataBirth;
            if ($city) {
                $user->city_id = $city->id;
            }
            $user->country_id = $country->id;
            $user->slug = $slug;
            $user->picture = '/images/user-profile.png';
            $user->password = $pass;
            $user->save();

            $user->roles()->attach(3);

            $team = new Team;
            $team->salary = $request->salary;
            $team->note = $request->note;
            $team->user_id = $user->id;
            $team->save();

            for ($i = 0; $i < count($positionTeam); $i++) {
                $team->teamPosition()->attach($positionTeam[$i]->id);
            }

            for ($i = 0; $i < count($archives); $i++) {
                $team->archive()->create([
                    'nameArchive' => $archives[$i]->nameArchive,
                    'uuid' => $archives[$i]->uuid,
                    'type' => $archives[$i]->extension,
                    'archive' => $archives[$i]->urlArchive,
                    'archivable_id' => $team->id,
                    'archivable_type' => get_class($team)
                ]);
            }
            Mail::to($user->email)->locale($language->code)->send(new RegisterTeam($user->name, $password, $user->email));

        } catch (\Exception $exception) {
            $success = $exception->getMessage();
            DB::rollBack();
        }
        if ($success === true) {
            DB::commit();
            return response()->json('Transacción realizada exitosamente', 200);
        } else {
            return response()->json('Error al realizar la transaccion', 500);
        }
    }
}
