<?php

namespace App\Http\Controllers\Frontend\Projects;

use App\Events\Backend\NewProject;
use App\Events\Backend\NewProjectNotification;
use App\Events\PrivateMessage;
use App\Events\PublicMessage;
use App\Http\Controllers\Controller;
use App\Mail\Project\NewProjectCustomer;
use App\Model\Answer;
use App\Model\Company;
use App\Model\Customer;
use App\Model\Project;
use App\Notifications\Customer\TelegramNewProjectNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProjectsController extends Controller
{
    public function index()
    {
        return view('frontend.pages.projects.projects');
    }

    public function indexNewProject()
    {
        return view('frontend.pages.projects.new-project');
    }

    public function getDatatableProjectsCompany()
    {
        $customer = Auth::user()->customer;
        $projects = Project::with('user', 'typeProject', 'project_categories')->whereHas('customer', function ($q) use($customer){
            $q->where('customer_id', $customer->id);
        })->get();
        return datatables()->of($projects)->toJson();
    }

    public function storeNewProyect(Request $request)
    {
//        dd(json_decode($request->toAssingCompany));
        $customer = Customer::where('user_id', \auth()->user()->id)->with('user')->first();
        $company = json_decode($request->toAssingCompany);
        $languageApplication = \session('language');
        $project_name = $request->nameProject;
        $typeProject = json_decode($request->typeProject);
        $briefProject = json_decode($request->briefProject);
        $categoriesProject = json_decode($request->categoriesProject);
        $observationsProject = $request->observationsProject;
        $user_name = \auth()->user()->name;
        $ramdon = Str::random(10);
        $path = '/images/img-logo-empresa.png';
        $slugProject = null;
        if ($company){
            $slugProject = Str::slug($project_name . '-' . $company->name . '-' .$customer->user->name.'-'. $ramdon, '-');
        }else{
            $slugProject = Str::slug($project_name .'-' .$customer->user->name.'-'. $ramdon, '-');

        }

        $items = [];
        foreach ($categoriesProject as $names) {
            array_push($items, $names->name->es);
        }
        $categoriesProjectName = implode(', ', $items);
        $success = true;
        $project = null;
//        DB::beginTransaction();
//        try {

            $project = Project::create([
                'name' => $project_name,
                'picture' => $path,
                'type_project_id' => $typeProject->id,
                'slug' => $slugProject,
                'observations' => $observationsProject,
            ]);
            foreach ($categoriesProject as $category) {
                $project->project_categories()->attach($category->id);
            }
            foreach ($briefProject as $value) {
                if (isset($value->model) || !empty($value->pathsRecording)) {
                    $answer = new Answer;
                    $answer->answer = isset($value->model) ? $value->model : null;
                    $answer->project_id = $project->id;
                    $answer->question_id = $value->id;
                    $answer->audio = json_encode($value->pathsRecording);
                    $answer->save();

                }
            }
            if ($company){
                $project->customer()->attach($customer->id);
                $project->company()->attach($company->id);
            }else{
                $project->customer()->attach($customer->id);
            }

            $urlProject = env('APP_URL') . '/project/' . $slugProject;

            $itemsLanguage = [];
            foreach ($categoriesProject as $names) {
                array_push($itemsLanguage, $names->name->$languageApplication);
            }
            $categoriesProjectNameLanguages = implode(', ', $itemsLanguage);
            Mail::to(\auth()->user()->email)->locale(session('language'))->send(
                new NewProjectCustomer(
                    $user_name,
                    $company ? $company->name : null,
                    $project_name,
                    $urlProject,
                    $observationsProject, $typeProject->name->$languageApplication,
                    $categoriesProjectNameLanguages
                ));
            /*Función para enviar notificación a un canal de TELEGRAM*/
            $this->sendMessageTelegramNewProject($company ? $company->name : null, $project_name, $categoriesProjectName, $typeProject, $urlProject);
//        } catch (\Exception $exception) {
//            $success = $exception->getMessage();
//            DB::rollBack();
//        }
//        if ($success === true) {
            DB::commit();
            $projectGet = Project::where('id', $project->id)->first();

            $notificationProject = (object) [
                'id' => $projectGet->id,
                'nameUser' => $customer->user->name,
                'lastNameUser' => $customer->user->last_name,
                'pictureUser' => $customer->user->picture,
                'nameProject' => $projectGet->name,
                'slugProject' => $projectGet->slug,
            ];

            $users = User::role('Administrator')->get();
            $notifications = null;
            foreach ($users as $user => $valor){
                $notification = new \App\Model\Notification;
                $notification->notification = json_encode($notificationProject);
                $notification->user_id = $valor->id;
                $notification->save();
            }

            broadcast(new NewProjectNotification($notificationProject))->toOthers();
            return response()->json('Transacción realizada exitosamente', 200);
//        } else {
//            return response()->json('Error al realizar la transaccion', 500);
//        }
    }

    public function sendMessageTelegramNewProject($company, $project_name, $categoriesProject, $typeProject, $url)
    {
        $user_name = \auth()->user()->name;
        $user_lastname = \auth()->user()->last_name;
        $gif = $this->gifsGoodRamdon();
        $text = null;
        if ($company){
            $text =
                "Este mensaje es para notificar \n"
                . "que la empresa <b>" . $company . "</b>\n"
                . "representada por <b>" . $user_name . " " . $user_lastname . "</b>\n"
                . "ha registrado un nuevo proyecto llamado <b>" . $project_name . ".</b>\n"
                . "\n"
                . "<b>           Datos del Proyecto</b>\n"
                . "\n"
                . "<b>Nombre del proyecto: </b>\n"
                . "" . $project_name . "\n"
                . "<b>Empresa: </b>\n"
                . "" . $company . "\n"
                . "<b>Tipo de Proyecto: </b>\n"
                . "" . $typeProject->name->es . "\n"
                . "<b>Características: </b>\n"
                . "" . $categoriesProject . "";
        }else{
            $text =
                "Este mensaje es para notificar \n"
                . "que el cliente <b>" . $user_name . " " . $user_lastname . "</b>\n"
                . "ha registrado un nuevo proyecto llamado <b>" . $project_name . ".</b>\n"
                . "\n"
                . "<b>           Datos del Proyecto</b>\n"
                . "\n"
                . "<b>Nombre del proyecto: </b>\n"
                . "" . $project_name . "\n"
                . "<b>Cliente: </b>\n"
                . "" . $user_name . " " . $user_lastname . "\n"
                . "<b>Tipo de Proyecto: </b>\n"
                . "" . $typeProject->name->es . "\n"
                . "<b>Características: </b>\n"
                . "" . $categoriesProject . "";
        }


        Notification::send($user_name, new TelegramNewProjectNotification(env('TELEGRAM_CHANNEL_ID'), $text, $gif, $url));
    }

    public function gifsGoodRamdon()
    {
        $gifs = [
            'https://media.giphy.com/media/fDbzXb6Cv5L56/giphy.gif',
            'https://media.giphy.com/media/8fen5LSZcHQ5O/giphy.gif',
            'https://media.giphy.com/media/3rgXBOmTlzyFCURutG/giphy.gif',
            'https://media.giphy.com/media/l3q2SH4Cmhh8F40jS/giphy.gif',
            'https://media.giphy.com/media/LXHJRRjnviw7e/giphy.gif',
            'https://media.giphy.com/media/msKNSs8rmJ5m/giphy.gif',
            'https://media.giphy.com/media/yhekrBGjZhs2I/giphy.gif',
            'https://media.giphy.com/media/1GrsfWBDiTN60/giphy.gif',
            'https://media.giphy.com/media/5xaOcLGvzHxDKjufnLW/giphy.gif',
            'https://media.giphy.com/media/DKnMqdm9i980E/giphy.gif'
        ];
        return $this->array_random($gifs, 1);
    }

    public function array_random($array, $amount = 1)
    {
        $keys = array_rand($array, $amount);

        if ($amount == 1) {
            return $array[$keys];
        }

        $results = [];
        foreach ($keys as $key) {
            $results[] = $array[$key];
        }

        return $results;
    }
}
