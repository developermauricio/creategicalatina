<?php

namespace App\Http\Controllers\Backend\Provider;

use App\Http\Controllers\Controller;
use App\Mail\Register\RegisterCompany;
use App\Model\Company;
use App\Model\Manager;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CreateProviderController extends Controller
{
    public function index(){
        return view('backend.pages.provider.create-provider');
    }

    public function storeCreateProvider(Request $request){
        $password = Str::random(8);
        $pass = bcrypt($password);

        $typeCompany = json_decode($request->typeCompany);
        $countryCompany = json_decode($request->countryCompany);
        $cityCompany = json_decode($request->cityCompany);
        $pictureCompany= json_decode($request->pictureCompany);
        $typeIdentRepresent = json_decode($request->typeIdentRepresent);
        $typePosition = json_decode($request->typePositionRepresent);
        $language = json_decode($request->languageEmail);
        $ramdon = Str::random(10);
        $slugCompany = Str::slug($request->nameCompany .'-' .$ramdon, '-');
        /*Validar si la empresa tiene foto*/
        $path = '/images/img-logo-empresa.png';
        if ($pictureCompany) {
            $path = $pictureCompany->data;
        }
        $success = true;
        DB::beginTransaction();
        try {
            /*Se registra el representante*/
            $slugRepresent = Str::slug($request->nameRepresent . '-' . $request->lastNameRepresent . '-' . $ramdon, '-');
            $user = new User;
            $user->name = ucwords($request->nameRepresent);
            $user->last_name = ucwords($request->lastNameRepresent);
            $user->email = $request->emailRepresent;
            $user->phone = $request->phoneRepresent;
            $user->identification_type_id = $typeIdentRepresent->id;
            $user->identification = $request->identificationRepresent;
            $user->slug = $slugRepresent;
            $user->picture = '/images/user-profile.png';
            $user->password = $pass;
            $user->save();
            /*Se registra el manager*/
            $manager = new Manager;
            $manager->user_id = $user->id;
            $manager->position_id = $typePosition->id;
            $manager->save();

            $user->roles()->attach([2]);
            /*Se registra la empresa*/
            $company = new Company;
            $company->name = $request->nameCompany;
            $company->address = $request->addressCompany;
            $company->email = $request->emailCompany;
            $company->nit = $request->nitCompany;
            $company->company_category_id = $typeCompany->id;
            $company->phone = $request->phoneCompany;
            $company->picture = $path;
            $company->biography = $request->biographyCompany;
            $company->country_id = $countryCompany->id;
            $company->manager_id = $manager->id;
            if ($cityCompany) {
                $company->city_id = $cityCompany->id;
            }
            $company->slug = $slugCompany;
            $company->url_youtube = $request->url_youtube;
            $company->url_instagram = $request->url_instagram;
            $company->url_apple_music = $request->url_applemusic;
            $company->url_facebook = $request->url_facebook;
            $company->url_spotify = $request->url_spotify;
            $company->url_tiktok = $request->url_tiktok;
            $company->url_twitch = $request->url_twitch;
            $company->url_twitter = $request->url_twitter;
            $company->web_site = $request->url_website;
            $company->save();

            $company->companyType()->attach('2');

            Mail::to($user->email)->locale($language->code)->send(new RegisterCompany($user->name, $password, $user->email, $company->name));

        }catch (\Exception $exception) {
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
