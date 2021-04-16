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
Route::post('/save-recording-brief', 'Controller@saveRecordingBrief')->name('save.recording.brief');
Route::post('/removed-recording-brief', 'Controller@removedRecordingBrief')->name('removed.recording.brief');
Route::post('/save-session-tour', 'Controller@sessionSaveTour')->name('session.save.tour.frontend');

Route::get('/get-type-projects', 'Controller@getTypeProject')->name('api.get.type.projects');
Route::get('/get-categories-projects/{id}', 'Controller@getCategoriesProject')->name('api.get.categories.projects');
Route::get('/get-brief/{id}', 'Controller@getBrief')->name('api.get.brief.projects');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['namespace' => 'Backend'], function () {
        /*=============================================
        API DATATABLE BACKEND
        =============================================*/
        Route::get('datable-all-customer', 'Customer\CustomerController@getDatableCustomers')->name('api.backend.all.customer');
        /*=============================================
        API PARA MODULO CLIENTE CLIENTE
        =============================================*/
        Route::post('/upload-picture-company','Customer\CreateCustomerController@ulploadPictureCompany')->name('api.upload.picture.company');
        Route::get('/get-type-position','Customer\CreateCustomerController@getTypePosition')->name('api.get.type.position');
        Route::post('/removed-picture-company','Customer\CreateCustomerController@removedPictureCompany')->name('api.removed.picture.company');
        Route::post('/register/store-company','Customer\CreateCustomerController@storeCreateCompany')->name('api.store.create.company');

    });
    /*=============================================
    API PARA EL FRONTEND
    =============================================*/
    Route::group(['namespace' => 'Frontend'], function () {
        /*=============================================
        API DATATABLE BACKEND
        =============================================*/
        Route::get('datable-all-project-company', 'Projects\ProjectsController@getDatatableProjectsCompany')->name('api.frontend.all.projects.company');
    });
});
Route::get('/verify-email-user/{email}', 'Controller@validateEmail')->name('api.validate.email');
Route::get('/verify-email-company/{email}', 'Controller@validateEmailCompany')->name('api.validate.email.company');
Route::get('get-countries', 'Controller@getCountries')->name('api.get.countries');
Route::get('get-cities/{country}', 'Controller@getCities')->name('api.get.cities');
Route::get('/get-identificationtype', 'Controller@getIdentificationType')->name('api.get.identificationtype');
Route::get('/get-type-company', 'Controller@getTypeCompanies')->name('api.get.type.companies');


