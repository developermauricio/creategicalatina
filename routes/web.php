<?php

use App\Model\Company;
use App\Model\TypeProject;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/cambiar-background', function (){
//   return response()->json(['data' => 'no']);
//});
Route::get('/', function (){
    return view('welcome');
});

Route::get('/chat', function (){
  event(new \App\Events\PublicMessage());
  dd('Public evento ejecutado');
});

Route::get('/private-chat', function (){
    event(new \App\Events\PrivateMessage(\auth()->user()));
    dd('Privado evento ejecutado');
});

Route::get('/send-message', 'Controller@sendMessage')->name('send.message');

Route::get('companies-pro', function (){
    $getCompanies = Company::getCompanyType(1);
    return datatables()->of($getCompanies)->toJson();
});

Route::get('/email', function (){
    return new \App\Mail\Project\NewProjectCustomer(
        'Mauricio', 'APEX',
        'project', '',
        'Software', 'escritori, movile'
    );
});

/*=============================================
LENGUAJE
=============================================*/
Route::get('set_lenguage/{lang}', 'Controller@setLanguage')->name('set_lenguage');


/*=============================================
RUTAS PARA EL FRONTEND
=============================================*/
//Route::group(['prefix' => '{locale}', 'namespace' => 'Frontend'], function () {
//    Route::get('/request-project', 'RegisterClientController@index')->name('frontend.index.register.client');
//});

/*RUTAS PARA EL REGISTRO DE USUARIOS*/
Route::group(['prefix' => '{locale}', 'middleware' => 'auth'], function () {

    Route::get('/dashboard', function () {
        return view('layouts.app');
    });

    /*=============================================
       RUTAS PARA EL BACKEND
    =============================================*/

    Route::group(['namespace' => 'Backend'], function (){
        /* RUTAS CLIENTE*/
        Route::get('/customers', 'Customer\CustomerController@index')->name('backend.customer.customer');
        Route::get('/new-customers', 'Customer\CreateCustomerController@index')->name('backend.customer.create.customer');
        Route::get('/customers/profile/{company}', 'Customer\ProfileCustomerController@index')->name('backend.customer.profile.customer');

        /* RUTAS PROVEEDORES*/
        Route::get('/providers', 'Provider\ProviderController@index')->name('backend.provider.provider');
        Route::get('/new-providers', 'Provider\CreateProviderController@index')->name('backend.provider.create.provider');
        /* RUTAS PERFIL*/
        Route::get('/admin/profile/{user}', 'Profile\ProfileController@index')->name('backend.profile');
    });
    /*=============================================
      RUTAS PARA EL FRONTEND
   =============================================*/
    Route::group(['namespace' => 'Frontend'], function (){
        /* RUTAS PARA LOS PROYECTOS*/
        Route::get('/projects', 'Projects\ProjectsController@index')->name('frontend.projects.projects');
        Route::get('/new-project', 'Projects\ProjectsController@indexNewProject')->name('frontend.projects.index.new.project');
    });
});


//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Auth\LoginController@login');

Auth::routes();

