<?php

use App\Model\Company;
use App\Model\Customer;
use App\Model\TypeProject;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
Route::get('/', function () {
    return view('welcome');
});
Route::get('/mercado-pago', 'Payment\PaymentController@getConfigMercadoPago')->name('mercado.pago');
Route::get('/prueba-email', function (){
 return new \App\Mail\purchaseOrder\SendEmailPurchaseOrder('Mauricio', '985921', 'German Melez', 'oamoamsoamsoas', '27-23-2021', 'ORDEN DE PAGO', 'AAMSOAMSOAMSO');
});

Route::get('/project/{id}', function ($id) {
    $project = \App\Model\Project::where('id', $id)->with('customer.user', 'company')->first();
    return $project;
});

Route::get('/tiene-empresa', function () {
    $customer = Customer::where('user_id', \auth()->user()->id)->with('user')->first();
//    $company = Company::where('customer_id', $customer->id)->get();

    return $customer->user->name;
})->middleware('hasCompanies');

Route::get('/chat', function () {
    event(new \App\Events\PublicMessage());
    dd('Public evento ejecutado');
});

Route::get('/private-chat', function () {
    event(new \App\Events\PrivateMessage(\auth()->user()));
    dd('Privado evento ejecutado');
});

Route::get('/send-message', 'Controller@sendMessage')->name('send.message');

Route::get('/teams', function () {
    $getCompanies = \App\Model\Team::getCompanyType(1);
    return datatables()->of($getCompanies)->toJson();
});

Route::get('/email', function () {
    return new \App\Mail\Register\RegisterTeam(
        'Mao',
        'sdsdsd',
        'ma@mgial.com'
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
//Route::group(['prefix' => '{locale}', 'middleware' => 'auth'], function () {
Route::group(['prefix' => '{locale}', 'middleware' => 'auth'], function () {

    Route::get('/dashboard', function () {
        return view('layouts.app');
    });

    // BEGIN: Rutas de pasalelas de pago
    /* Route::get('/payment', function (){
        return view('payment.payment');
    }); */
    Route::get('/payment', 'HomeController@indexPayment')->name('home.payment');
    Route::post('/payment/pay', 'Payment\PaymentController@pay')->name('pay');
    Route::get('/payment/approval', 'Payment\PaymentController@approval')->name('approval');
    Route::get('/payment/cancelled', 'Payment\PaymentController@cancelled')->name('cancelled');
    // END: Rutas de pasalelas de pago

    /*=============================================
       RUTAS PARA EL BACKEND
    =============================================*/

    Route::group(['namespace' => 'Backend'], function () {
        /* RUTAS CLIENTE*/
        Route::get('/customers', 'Customer\CustomerController@index')->name('backend.customer.customer');
        Route::get('/new-customers', 'Customer\CreateCustomerController@index')->name('backend.customer.create.customer');
        Route::get('/customers/profile/{company}', 'Customer\ProfileCustomerController@index')->name('backend.customer.profile.customer');

        /* RUTAS PROVEEDORES*/
        Route::get('/providers', 'Provider\ProviderController@index')->name('backend.provider.provider');
        Route::get('/new-providers', 'Provider\CreateProviderController@index')->name('backend.provider.create.provider');

        /* RUTAS TEAM*/
        Route::get('/members-team', 'Team\TeamController@index')->name('backend.team.team');
        Route::get('/new-member', 'Team\TeamCreateController@index')->name('backend.team.create.team');
        Route::get('/setup-team', 'Team\ConfigurationTeamController@index')->name('backend.team.setup.team');

        /* RUTAS PROYECTOS*/
        Route::get('/admin-projects', 'Project\ProjectController@index')->name('backend.projects.projects');
        Route::get('/admin-projects/{project}', 'Project\ProjectDetailController@index')->name('backend.projects.projects');
        Route::get('/project-setup', 'Project\ProjectSetupController@index')->name('backend.projects.setup');

        /* RUTAS PERFIL*/
        Route::get('/admin/profile/{user}', 'Profile\ProfileController@index')->name('backend.profile');
        Route::get('/admin/edit-profile/{user}', 'Profile\ProfileController@editProfile')->name('backend.edit.profile');

        /* RUTAS ORDENES DE PAGO*/
        Route::get('/purchase-orders', 'PurchaseOrder\PurchaseOrderController@index')->name('backend.purchase.orders');
        Route::get('/new-purchase-order', 'PurchaseOrder\CreatePurchaseOrderController@index')->name('backend.purchase.orders');
        Route::get('/admin/purchase-order-payment/{purchaseOrder}', 'PurchaseOrder\PurchaseOrderController@indexPurchaseOrderPayment')->name('backend.index.purcharse.send.payment');


        /* RUTAS FACTURAS*/
        Route::get('/admin/invoice-print/{invoice}', 'Invoice\InvoiceController@indexPrint')->name('backend.invoice.print');
        Route::get('/admin/invoice-payment/{invoice}', 'Invoice\InvoiceController@indexInvoicePayment')->name('backend.invoice.send.payment');

    });
    /*=============================================
      RUTAS PARA EL FRONTEND
   =============================================*/
    Route::group(['namespace' => 'Frontend'], function () {
        /* RUTAS PARA LOS PROYECTOS*/
        Route::get('/projects', 'Projects\ProjectsController@index')->name('frontend.projects.projects');
        Route::get('/new-project', 'Projects\ProjectsController@indexNewProject')->name('frontend.projects.index.new.project');

        /* RUTAS PARA MOSTRAR EMPRESAS ASOCIADAS A UN CLIENTE*/
        Route::get('/customer-companies', 'Companies\CompaniesController@index')->middleware('hasCompanies')->name('frontend.companies.customer.companies');
    });
});


//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Auth\LoginController@login');

Auth::routes();

