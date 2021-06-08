<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Provider;
use App\Model\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index(string $locale, User $user){
        $user = User::where('id', $user->id)->with('identificationType', 'city.country')->first();
        return view('backend.pages.profile.profile', compact('user'));
    }

    public function editProfile( string $locale, User $user ) {
        $roles = $user->roles->pluck('name');
        $currentUser = $user;

        foreach($roles as $role) {
            switch ($role) {
                case 'Administrator':
                    //Datos de admin
                    break 2;  // TODO: para salir de ambas estructuras
                case 'Customer':
                    $client = Customer::where('user_id', $user->id)->with('user', 'archive')->first();
                    if ($client) {
                        $currentUser = $client->user;
                        $currentUser->clientID = $client->id;
                        $currentUser->archives = $client->archive;
                    }
                    break 2;
                case 'Member':
                    $team = Team::where('user_id', $user->id)->with('user', 'archive')->first();
                    if ($team) {
                        $currentUser = $team->user;
                        $currentUser->memberID = $team->id;
                        $currentUser->archives = $team->archive;
                    }
                    break 2;
                case 'Provider':
                    $provider = Provider::where('user_id', $user->id)->with('user', 'archive')->first();
                    if ($provider) {
                        $currentUser = $provider->user;
                        $currentUser->providerID = $provider->id;
                        $currentUser->archives = $provider->archive;
                    }
                    break 2;
            }
        }

        $currentUser->roles = $roles;
        return view('backend.pages.profile.edit-profile', compact('currentUser'));
    }

    public function updateUserProfile( Request $request ) {
        $user = json_decode($request->user);

        DB::beginTransaction();
        try {
            $userUpdate = User::findOrFail($user->id);
            $userUpdate->identification = $user->identification;
            $userUpdate->identification_type_id = $user->identificationType->id;
            $userUpdate->name = $user->name;
            $userUpdate->last_name = $user->last_name;
            $userUpdate->address = $user->address;
            $userUpdate->email = $user->email;
            $userUpdate->phone = $user->phoneI;
            $userUpdate->biography = $user->biography;
            $userUpdate->slug = Str::slug($user->name . '-' . $user->last_name . '-' . Str::random(10), '-');
            $userUpdate->birthday = $user->birthday;
            $userUpdate->country_id = $user->country->id;
            $user->city ? $userUpdate->city_id = $user->city->id : '';

            if ( $request->hasFile('photo') ) {
                $path = '/storage/' . $request->file('photo')->store('users');
                $userpicture = str_replace('/storage', '', $user->picture);
                $userpicture ? Storage::delete($userpicture) : '';
                $userUpdate->picture = $path;
            }

            $userUpdate->url_facebook = $user->url_facebook;
            $userUpdate->url_youtube = $user->url_youtube;
            $userUpdate->url_instagram = $user->url_instagram;
            $userUpdate->url_tiktok = $user->url_tiktok;
            $userUpdate->url_twitter = $user->url_twitter;
            $userUpdate->url_twitch = $user->url_twitch;
            $userUpdate->url_spotify = $user->url_spotify;
            $userUpdate->url_apple_music = $user->url_apple_music;
            $userUpdate->web_site = $user->web_site;
            $userUpdate->update();
            DB::commit();

        } catch (\Exception $exception) {
            $msg = $exception->getMessage();
            DB::rollBack();
            return response()->json(['msg' => $msg, 'status' => 500 ]);
        }

        return response()->json(['msg' => 'Actualizacion exitosa.', 'status' => 200, 'user' => $userUpdate]);
    }
}
