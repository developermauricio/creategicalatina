<?php

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

/*=============================================
LENGUAJE
=============================================*/
Route::get('set_lenguage/{lang}', 'Controller@setLanguage')->name('set_lenguage');


/*=============================================
RUTAS PARA EL FRONTEND
=============================================*/
Route::group(['prefix' => '{locale}', 'namespace' => 'Frontend'], function () {
    Route::get('/request-project', 'RegisterClientController@index')->name('frontend.index.register.client');
});

/*RUTAS PARA EL REGISTRO DE USUARIOS*/
Route::group(['prefix' => '{locale}'], function () {
    Route::get('/', function (){
        return view('layouts.app-frontend');
    });
    Route::get('/dashboard', function () {
        return view('layouts.app');
    });

});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
