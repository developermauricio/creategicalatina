<?php

namespace App\Http\Controllers\Backend\Provider;

use App\Http\Controllers\Controller;
use App\Mail\Register\RegisterCompany;
use App\Mail\Register\RegisterCompanyProvider;
use App\Mail\Register\RegisterProviderPersonNatural;
use App\Model\Company;
use App\Model\Customer;
use App\Model\Manager;
use App\Model\PositionManager;
use App\Model\Provider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateProviderController extends Controller
{
    public function index(){
        return view('backend.pages.provider.create-provider');
    }

    public function getTypePosition()
    {
        $getTypePosition = PositionManager::all();
        return response()->json(['data' => $getTypePosition]);
    }

    public function ulploadPictureCompanyProvider(Request $request)
    {
        $success = true;
        $urlFinale = null;
        DB::beginTransaction();
        try {
            $picture = $request->file('picture');
            $pictureUrl = $picture->store('companies');
            $urlFinale = '/storage/' . $pictureUrl;
        } catch (\Exception $exception) {
            $success = $exception->getMessage();
            DB::rollBack();
        }
        if ($success === true) {
            DB::commit();
            return response()->json(['data' => $urlFinale]);
        } else {
            return response()->json('Error al realizar la transaccion', 500);
        }
    }

    public function uploadArchiveProviderCompany(Request $request)
    {
        $nameCompany = $request->input('nameCompany');
        $uuid = $request->input('nameId');
        $archive = $request->file('archive');
        $archiveExtension = $archive->getClientOriginalExtension();
        $ramdon = Str::random(10);
        $nameArchive = strtolower($nameCompany) . '-' . $ramdon . '-' . strtolower($archive->getClientOriginalName());
        $path = Storage::disk('public')->put('/archives/' . $nameArchive, file_get_contents($archive));
        $urlFinal = '/storage/archives/' . $nameArchive;
        return response()->json(['data' => $urlFinal, 'uuid' => $uuid, 'extension' => $archiveExtension]);
    }



    public function storeCreateCompanyProvider(Request $request)
    {
        $password = Str::random(8);
        $pass = bcrypt($password);
        $archives = json_decode($request->archives);
        $typeEntity = json_decode($request->typeEntity);
        $typeCompany = json_decode($request->typeCompany);
        $countryCompany = json_decode($request->countryCompany);
        $cityCompany = json_decode($request->cityCompany);
        $countryUser = json_decode($request->userCountry);
        $cityUser = json_decode($request->userCity);
        $pictureCompany = json_decode($request->pictureCompany);
        $typeIdentRepresent = json_decode($request->typeIdentRepresent);
        $typePosition = json_decode($request->typePositionRepresent);
        $language = json_decode($request->languageEmail);
        $ramdon = Str::random(10);
        $slugCompany = Str::slug($request->nameCompany . '-' . $ramdon, '-');
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
            if ($cityUser) {
                $user->city_id = $cityUser->id;
            }
            $user->country_id = $countryUser->id;
            $user->slug = $slugRepresent;
            $user->picture = '/images/user-profile.png';
            $user->password = $pass;
            $user->save();
            /*Se registra el manager*/
            $provider = new Provider;
            $provider->user_id = $user->id;
            $provider->position_id = $typePosition->id;
            $provider->company_category_id = $typeCompany->id;
            $provider->type_entitity_id = $typeEntity->id;
            $provider->save();

            $user->roles()->attach([4]);
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
            $company->provider_id = $provider->id;
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

            $company->companyType()->attach('1');

            for ($i = 0; $i < count($archives); $i++) {
                $provider->archive()->create([
                    'uuid' => $archives[$i]->uuid,
                    'type' => $archives[$i]->extension,
                    'archive' => $archives[$i]->urlArchive,
                    'archivable_id' => $provider->id,
                    'archivable_type' => get_class($provider)
                ]);
            }

            Mail::to($user->email)->locale($language->code)->send(new RegisterCompanyProvider($user->name, $password, $user->email, $company->name));

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

    public function storeCreatePersonaNaturalProvider(Request $request)
    {
        $password = Str::random(8);
        $pass = bcrypt($password);
        $archives = json_decode($request->archives);
        $typeEntity = json_decode($request->typeEntity);
        $typeCompany = json_decode($request->typeCompany);
        $countryUser = json_decode($request->userCountry);
        $cityUser = json_decode($request->userCity);
        $typeIdentRepresent = json_decode($request->typeIdentRepresent);
        $typePosition = json_decode($request->typePositionRepresent);
        $language = json_decode($request->languageEmail);
        $ramdon = Str::random(10);
        $success = true;
        DB::beginTransaction();
        try {
            /*Se registra el representante*/
            $slugRepresent = Str::slug($request->nameRepresent . '-' . $request->lastNameRepresent . '-' . $ramdon, '-');
            $user = new User;
            $user->name = ucwords($request->nameRepresent);
            $user->last_name = ucwords($request->lastNameRepresent);
            $user->email = $request->emailRepresent;
            $user->address = $request->addressRepresent;
            $user->phone = $request->phoneRepresent;
            $user->identification_type_id = $typeIdentRepresent->id;
            $user->identification = $request->identificationRepresent;
            if ($cityUser) {
                $user->city_id = $cityUser->id;
            }
            $user->country_id = $countryUser->id;
            $user->slug = $slugRepresent;
            $user->picture = '/images/user-profile.png';
            $user->password = $pass;

            $user->url_youtube = $request->url_youtube;
            $user->url_instagram = $request->url_instagram;
            $user->url_apple_music = $request->url_applemusic;
            $user->url_facebook = $request->url_facebook;
            $user->url_spotify = $request->url_spotify;
            $user->url_tiktok = $request->url_tiktok;
            $user->url_twitch = $request->url_twitch;
            $user->url_twitter = $request->url_twitter;
            $user->web_site = $request->url_website;

            $user->save();

            /*Se registra el manager*/
            $provider = new Provider;
            $provider->user_id = $user->id;
            $provider->position_id = $typePosition->id;
            $provider->company_category_id = $typeCompany->id;
            $provider->type_entitity_id = $typeEntity->id;
            $provider->save();

            $user->roles()->attach([4]);

            for ($i = 0; $i < count($archives); $i++) {
                $provider->archive()->create([
                    'uuid' => $archives[$i]->uuid,
                    'type' => $archives[$i]->extension,
                    'archive' => $archives[$i]->urlArchive,
                    'archivable_id' => $provider->id,
                    'archivable_type' => get_class($provider)
                ]);
            }

            Mail::to($user->email)->locale($language->code)->send(new RegisterProviderPersonNatural($user->name, $password, $user->email));
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


    public function removedPictureCompanyProvider(Request $request)
    {
        $pathImage = $request->get('pictureCompany');
        $partes_ruta = pathinfo($pathImage);
        Storage::delete('companies/' . $partes_ruta['basename']);
        dd($pathImage);
    }

    public function removedArchiveCompanyProvider(Request $request)
    {
        $pathArchive = $request->get('archiveCompany');
        $partes_ruta = pathinfo($pathArchive);
        Storage::delete('archives/' . $partes_ruta['basename']);
        dd($pathArchive);
    }
}
