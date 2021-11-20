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

Route::get('/cambiar-background', function (){
    return response()->json(['data' => 'si']);
});

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
        API DATATABLE BACKEND CLIENTE
        =============================================*/
        Route::get('datable-all-customer', 'Customer\CustomerController@getDatableCustomers')->name('api.backend.all.customer');
        /*=============================================
        API DATATABLE BACKEND PROVEEDOR
        =============================================*/
        Route::get('datable-all-provider', 'Provider\ProviderController@getDatableProvider')->name('api.backend.all.provider');
        /*=============================================
        API PARA MODULO CLIENTE CLIENTE
        =============================================*/
        Route::post('/upload-picture-company','Customer\CreateCustomerController@ulploadPictureCompany')->name('api.upload.picture.company');
        Route::post('/upload-archive-company','Customer\CreateCustomerController@uploadArchiveCustomerCompany')->name('api.upload.archive.company');
        Route::get('/get-type-position','Customer\CreateCustomerController@getTypePosition')->name('api.get.type.position');
        Route::post('/removed-picture-company','Customer\CreateCustomerController@removedPictureCompany')->name('api.removed.picture.company');
        Route::post('/removed-archive-company','Customer\CreateCustomerController@removedArchiveCompany')->name('api.removed.archive.company');
        Route::post('/register/store-company','Customer\CreateCustomerController@storeCreateCompany')->name('api.store.create.company');
        Route::post('/register/store-customer-person-natural','Customer\CreateCustomerController@storeCreatePersonaNaturalCustomer')->name('api.store.create.company');
        Route::get('/get-data-customer/{id}', 'Customer\CustomerController@getDataCustomer')->name('api.get.customer');
        Route::get('/get-data-company/{id}', 'Customer\CustomerController@getDataCompany')->name('api.get.company.sho');


        /*=============================================
        API PARA MODULO PROVEEDOR
        =============================================*/
        Route::get('datable-all-provider', 'Provider\ProviderController@getDatableProvider')->name('api.backend.all.provider');

        Route::post('/upload-archive-company-provider','Provider\CreateProviderController@uploadArchiveProviderCompany')->name('api.upload.archive.provider.company');
        Route::post('/upload-picture-company-provider','Provider\CreateProviderController@ulploadPictureCompanyProvider')->name('api.upload.picture.company');
        Route::post('/register/store-company-provider','Provider\CreateProviderController@storeCreateCompanyProvider')->name('api.store.create.provider.company');
        Route::post('/register/store-provider-person-natural','Provider\CreateProviderController@storeCreatePersonaNaturalProvider')->name('api.store.provider.create.person.natural');
        Route::post('/removed-picture-company-provider','Provider\CreateProviderController@removedPictureCompanyProvider')->name('api.removed.picture.company.provider');
        Route::post('/removed-archive-company-provider','Provider\CreateProviderController@removedArchiveCompanyProvider')->name('api.removed.archive.company');

        /*=============================================
        API PARA LOS PROYECTOS
        =============================================*/
        Route::get('datable-all-project-backend', 'Project\ProjectController@getDatatableProjects')->name('api.backend.all.projects');
        Route::get('count-state-project', 'Project\ProjectController@countStateProject')->name('api.count.state.project');
        Route::get('/get-brief-answer/{id}/{typeProject}', 'Project\ProjectDetailController@getAnswerBrief')->name('api.get.brief.answer.project');
        Route::get('/get-data-invoice-projects/{id}', 'Project\ProjectDetailController@getDataInvoice')->name('api.get.data.invoice.project');
        Route::get('/get-data-project/{id}', 'Project\ProjectController@getDataProject')->name('api.get.data.project');
        Route::get('/get-projects', 'Project\ProjectController@getProjects')->name('api.get.data.projects');
        Route::get('/get-project-create-purchase/{id}', 'Project\ProjectController@getDataProjectPurchase')->name('api.get.data.project.purchase');


        /*=============================================
         API PARA MODULO MIEMBROS O TEAMS
       =============================================*/
        Route::get('datable-all-teams', 'Team\TeamController@getDatableTeam')->name('api.backend.all.teams');
        Route::get('get-type-work-area', 'Team\TeamController@getTypeWorkArea')->name('api.get.type.work.area');
        Route::post('/register/store-team','Team\TeamCreateController@storeCreateTeam')->name('api.store.create.team');
        Route::post('/upload-archive-team','Team\TeamCreateController@uploadArchiveTeam')->name('api.upload.archive.team');
        Route::post('/removed-archive-team','Team\TeamCreateController@removedArchiveTeam')->name('api.removed.archive.company');
        Route::get('/grid-list-team', 'Team\TeamController@getListGridTeam')->name('api.get.list.grid.team');


        /*================================
            API PARA MODULO DE PERFIL
        ==================================*/
        Route::post('/update/user-profile','Profile\ProfileController@updateUserProfile')->name('api.update.user.profile');

        /*=============================================
        API PARA LAS FACTURAS
        =============================================*/
        Route::post('/register/store-invoice', 'Invoice\InvoiceController@storeCreateInvoice')->name('api.store.invoice.create');

        /*=============================================
        API PARA MODULO ORDENES DE PAGO
        =============================================*/
        Route::get('datable-all-purchase-orders', 'PurchaseOrder\PurchaseOrderController@getDatableProvider')->name('api.backend.all.purchase.order');
        Route::post('/register/store-purchase-order', 'PurchaseOrder\CreatePurchaseOrderController@storeCreatePurchaseOrder')->name('api.store.purchase.order');
        Route::post('/store-send-email-purchase-order', 'PurchaseOrder\PurchaseOrderController@sendEmailPurchaseOrder')->name('api.send.email.purchase.order');
        Route::get('/get-data-purchase-order/{id}', 'PurchaseOrder\PurchaseOrderController@getDataPurchase')->name('api.get.data.purchase');


    });
    /*=============================================
    API PARA EL FRONTEND
    =============================================*/
    Route::group(['namespace' => 'Frontend'], function () {
        /*=============================================
        API PARA LOS PROYECTOS
        =============================================*/
        Route::get('datable-all-project-company', 'Projects\ProjectsController@getDatatableProjectsCompany')->name('api.frontend.all.projects.company');
        Route::post('create-new-project', 'Projects\ProjectsController@storeNewProyect')->name('api.frontend.create.new.project');

        /*=============================================
        API PARA LAS EMPRESAS
        =============================================*/
        Route::get('/get-companies-customer', 'Companies\CompaniesController@companiesCustomer')->name('api.get.companies.customer');
    });

    /*=============================================
    API PARA LOS USUARIOS
    =============================================*/
    Route::post('/update-password-user', 'Controller@updatePasswordUser')->name('upadate.password.user');
});

Route::get('json-country', 'controller@jsonCountry');
Route::get('/verify-email-user/{email}', 'Controller@validateEmail')->name('api.validate.email');
Route::get('/verify-email-company/{email}', 'Controller@validateEmailCompany')->name('api.validate.email.company');
Route::get('get-countries', 'Controller@getCountries')->name('api.get.countries');
Route::get('get-cities/{country}', 'Controller@getCities')->name('api.get.cities');
Route::get('/get-identificationtype', 'Controller@getIdentificationType')->name('api.get.identificationtype');
Route::get('/get-type-company', 'Controller@getTypeCompanies')->name('api.get.type.companies');
Route::get('/get-type-entities', 'Controller@getTypeEntities')->name('api.get.type.entities');
Route::get('/get-position-team/{idWorkArea}', 'Controller@getPositionTeam')->name('api.get.position.team');
Route::get('/get-invoice-types', 'Controller@getInvoiceTypes')->name('api.get.invoice.type');

/*=============================================
        API PARA LOS METODOS DE PAGO
        =============================================*/
Route::get('/get-type-payments', 'Payment\PaymentController@getMethodsPayment')->name('get.methods.payment');

/*=============================================
        API PARA LAS NOTIFICACIONES
=============================================*/
Route::post('/new-notification-project', 'Controller@setNotificationProyect')->name('set.notification.project');
Route::get('/get-notification-user/{id}', 'Controller@getNotificationProyect')->name('get.notification.project');
Route::post('/viewed-notification', 'Controller@viewedNotificationProyect')->name('viewed.notification.project');
Route::get('/get-all-notifications-user', 'Controller@getNotificationAllUser')->name('get.all.notification.user');
Route::post('/state-notification-change', 'Controller@stateNotificationChange')->name('state.notification.change');
Route::post('/delete-notification', 'Controller@deleteNotification')->name('delete.notification');

Route::get('/filter-email/{email}', 'Controller@filterEmail')->name('api.filter.email');


