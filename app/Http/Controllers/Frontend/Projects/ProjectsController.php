<?php

namespace App\Http\Controllers\Frontend\Projects;

use App\Http\Controllers\Controller;
use App\Mail\Project\NewProjectCustomer;
use App\Model\Answer;
use App\Model\Company;
use App\Model\Project;
use App\Notifications\Customer\TelegramNewProjectNotification;
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
        $projectsCompany = Company::companyGetProjects();
        return datatables()->of($projectsCompany)->toJson();
    }

    public function storeNewProyect(Request $request)
    {
        $company = Company::getCompany();
        $languageApplication = \session('language');
        $project_name = $request->nameProject;
        $typeProject = json_decode($request->typeProject);
        $briefProject = json_decode($request->briefProject);
        $categoriesProject = json_decode($request->categoriesProject);
        $observationsProject = $request->observationsProject;
        $user_name = \auth()->user()->name;
        $ramdon = Str::random(10);
        $path = '/images/img-logo-empresa.png';
        $slugProject = Str::slug($project_name . '-' . $company->name . '-' . $ramdon, '-');

        $items = [];
        foreach ($categoriesProject as $names) {
            array_push($items, $names->name->es);
        }
        $categoriesProjectName = implode(', ', $items);
        $success = true;
        DB::beginTransaction();
        try {
            $project = new Project;
            $project->name = $project_name;
            $project->picture = $path;
            $project->user_id = \auth()->user()->id;
            $project->type_project_id = $typeProject->id;
            $project->slug = $slugProject;
            $project->observations = $observationsProject;
            $project->save();
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
            $project->company()->attach($company->id);
            $urlProject = env('APP_URL') . '/project/' . $slugProject;

            $itemsLanguage = [];
            foreach ($categoriesProject as $names) {
                array_push($itemsLanguage, $names->name->$languageApplication);
            }
            $categoriesProjectNameLanguages = implode(', ', $itemsLanguage);
            Mail::to(\auth()->user()->email)->locale(session('language'))->send(
                new NewProjectCustomer(
                    $user_name, $project_name, $urlProject,
                    $observationsProject, $typeProject->name->$languageApplication,
                    $categoriesProjectNameLanguages
                ));
            /*Función para enviar notificación a un canal de TELEGRAM*/
            $this->sendMessageTelegramNewProject($company->name, $project_name, $categoriesProjectName, $typeProject, $urlProject);
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

    public function sendMessageTelegramNewProject($company, $project_name, $categoriesProject, $typeProject, $url)
    {
        $user_name = \auth()->user()->name;
        $user_lastname = \auth()->user()->last_name;
        $gif = $this->gifsGoodRamdon();
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
