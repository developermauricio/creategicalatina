<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(string $locale, User $user){
        $user = User::where('id', $user->id)->with('identificationType', 'city.country')->first();
        return view('backend.pages.profile.profile', compact('user'));
    }

}
