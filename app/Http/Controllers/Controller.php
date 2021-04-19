<?php

namespace App\Http\Controllers;

use App\Model\City;
use App\Model\Company;
use App\Model\CompanyCategory;
use App\Model\Country;
use App\Model\IdentificationType;
use App\Model\ProjectCategory;
use App\Model\Question;
use App\Model\TypeProject;
use App\Notifications\Customer\TelegramNewProjectNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use \Illuminate\Support\Facades\Notification;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function sendMessage(){
        $user = -1001328650723;
        $gif = 'https://media.giphy.com/media/yyZRSvISN1vvW/giphy.gif';
        $text =
              "Este mensaje es para notificar \n"
            . "que la empresa <b>Creategicalatina</b>\n"
            . "representada por <b>Silvio Mauricio Gutierrez</b>\n"
            . "ha registrado un nuevo proyecto llamado <b>APEX.</b>\n"
            . "\n"
            . "<b>           Datos del Proyecto</b>\n"
              . "\n"
            . "<b>Nombre del proyecto: </b>\n"
            . "APEX\n"
            . "<b>Empresa: </b>\n"
            . "Creategicalatina\n"
            . "<b>Tipo de Proyecto: </b>\n"
            . "Software\n"
            . "<b>Características: </b>\n"
            . "Aplicación Movil, Plataforma Web, Aplicación de Escritorio, Ecommerce";

        Notification::send($user, new TelegramNewProjectNotification(env('TELEGRAM_CHANNEL_ID'), $text, $gif));
        return 'hola bebe';
    }

    public function setLanguage(string $language)
    {
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

    public function sessionChangeTheme(Request $request, $value)
    {
        $request->session()->put('theme', $value);
    }

    public function sessionChangeSidebarBackend(Request $request, $value)
    {
        $request->session()->put('sidebarMenuBackend', $value);
    }

    public function sessionSaveTour(Request $request)
    {
        $request->session()->put('sessionTourRegisterProject', '1');
    }

    public function getTypeProject()
    {
        $getTypeProject = TypeProject::with('brief.question')->get();
        return response()->json(['data' => $getTypeProject]);
    }

    public function getCategoriesProject($id)
    {
        $getCategoriesProjects = ProjectCategory::where('type_project_id', $id)->get();
        return response()->json(['data' => $getCategoriesProjects]);
    }

    public function getBrief($id)
    {
        $getQuestions = Question::where('brief_id', $id)->get();
        return response()->json(['data' => $getQuestions]);
    }

    public function getCountries()
    {
        $getCountries = Country::all();
        return response()->json(['data' => $getCountries]);
    }

    public function getCities($country)
    {
        $getCities = City::where('country_code', $country)->get();
        return response()->json(['data' => $getCities]);
    }

    public function getIdentificationType()
    {
        $getIdentificationType = IdentificationType::all();
        return response()->json(['data' => $getIdentificationType]);
    }

    public function getTypeCompanies()
    {
        $getTypeCompany = CompanyCategory::all();
        return response()->json(['data' => $getTypeCompany]);
    }

    public function validateEmail($email)
    {
        $check = User::whereEmail($email)->first();
        if ($check) {
            return response()->json('El correo electrónico ya ha sido registrado, por favor ingrese otro', 200);
        }
    }

    public function validateEmailCompany($email)
    {
        $check = Company::whereEmail($email)->first();
        if ($check) {
            return response()->json('El correo electrónico ya ha sido registrado, por favor ingrese otro', 200);
        }
    }

    public function saveRecordingBrief(Request $request)
    {
        $id = $request->id;
        $audio = $request->file('audio');
        $fileNama = $request->fileName . '-' . Str::random(20) . '.mp3';
        $pictureUrl = $audio->storeAs(
            'companies', str_replace(' ', '-', $fileNama)
        );
        return response()->json(['data' => $pictureUrl, 'id' => $id]);
    }
    public function removedRecordingBrief(Request $request){
        $path = $request->path;
//        $pathImage = $request->get('pictureCompany');
//        $partes_ruta = pathinfo($pathImage);
        Storage::delete($path);

    }
}
