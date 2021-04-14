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
Route::get('companies', function (){
    $getCompanies = Company::with('manager.user', 'city')->get();
    return datatables()->of($getCompanies)->toJson();
});

Route::get('/email', function (){
    return new \App\Mail\Register\RegisterCompany('Mauricio', 'sqwoqmwa5s', 'mao@gmail.com', 'Creategica');
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

