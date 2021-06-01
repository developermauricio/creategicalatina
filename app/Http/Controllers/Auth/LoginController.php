<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function redirectPath()
    {
        $userAdministrator = \auth()->user()->hasRole('Administrator');
        $userMmeber = \auth()->user()->hasRole('Member');
        $userCustomer = \auth()->user()->hasRole('Customer');
        if ($userAdministrator || $userMmeber){
            return sprintf('/%s/dashboard', session('language'));
        }else if ($userCustomer){
            return sprintf('/%s/projects', session('language'));
        }

    }

    public function logout(Request $request)
    {
        $sessionLanguage = session('language');
        $sessionTheme = session('theme');
        $sessionSidebarBackend = session('sidebarMenuBackend');
        $sessionTourRegisterProject = session('sessionTourRegisterProject');
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->put('language',  $sessionLanguage);
        $request->session()->put('theme',  $sessionTheme);
        $request->session()->put('sidebarMenuBackend',  $sessionSidebarBackend);
        $request->session()->put('sessionTourRegisterProject',  $sessionTourRegisterProject);

        return redirect('/login');
    }
}
