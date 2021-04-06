<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/session-theme-change/{value}', 'Controller@sessionChangeTheme')->name('session.change.theme');
Route::post('/session-sidebar-backend/{value}', 'Controller@sessionChangeSidebarBackend')->name('session.change.sidebar.backend');
Route::post('/save-session-tour', 'Controller@sessionSaveTour')->name('session.save.tour.frontend');

Route::get('/get-type-projects', 'Controller@getTypeProject')->name('api.get.type.projects');
Route::get('/get-categories-projects/{id}', 'Controller@getCategoriesProject')->name('api.get.categories.projects');
Route::get('/get-brief/{id}', 'Controller@getBrief')->name('api.get.brief.projects');
