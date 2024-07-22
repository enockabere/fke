<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Route;

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

//login - register routes
Route::get('/', function () {
    return view('registration.login');
});

Route::get('/register', 'GeneralController@register');
Route::get('/register-2/{regno}', 'GeneralController@registerstep2');
Route::post('/login', 'GeneralController@login');
Route::get('/logout', 'GeneralController@logout');
Route::post('/createaccount', 'GeneralController@createaccount');
Route::post('/createaccountstep2', 'GeneralController@createaccountstep2');
Route::get('/email/verify/{token}/{IncNo}', 'GeneralController@emailVerification');
Route::get('/resend/{IncNo}', 'GeneralController@resendVerification');
Route::get('/home', 'GeneralController@index')->name('home');
Route::get('/dashboard', 'GeneralController@dashboard');
Route::get('/requestservice', 'GeneralController@RequestService');
Route::post('/resetPassword', 'GeneralController@resetPassword');
Route::post('/forgotPassword', 'GeneralController@forgotPassword');
Route::get('/verify', 'GeneralController@verify');
Route::post('/newPassword', 'GeneralController@newPassword');
//General Routes
Route::get('/categories/{regno}', 'GeneralController@prospcategories');
Route::get('/memcategories/{no}', 'GeneralController@memcategories');
Route::get('/employees', 'GeneralController@employees');
Route::get('/branches', 'GeneralController@branches');
Route::get('/industries', 'GeneralController@industries');
Route::get('/notifications', 'GeneralController@notifications');
Route::get('/TemplateDownloads', 'GeneralController@TemplateDownloads');

//User Routes:
Route::get('/users', 'UsersController@getUsers');
Route::get('/associatedcompanies', 'UsersController@getAssociatedCompanies');
Route::get('/addUser/{user}', 'UsersController@addUser');
Route::get('/createUser', 'UsersController@createUser');
Route::post('/createCompany', 'UsersController@createCompany');
Route::get('/companies', 'UsersController@companies');
Route::get('/designations', 'UsersController@designations');

//Event Routes
Route::get('/upcomingevents', 'EventsController@getUpcomingEvents');
Route::get('/viewevent/{eventno}', 'EventsController@viewevent');
Route::post('/registerevent', 'EventsController@registerevent');
Route::post('/add-event', 'EventsController@addevent');
Route::get('/myevents', 'EventsController@myevents');
Route::get('/myeventdetails/{no}','EventsController@myeventdetails');

//Documents Admin
Route::get('/documents-admin', 'DocumentsAdminController@index');
Route::get('/documents-admin/create', 'DocumentsAdminController@create');
Route::get('/documents-admin/show-edit/{no}', 'DocumentsAdminController@showEdit');
Route::post('/documents-admin/create-update', 'DocumentsAdminController@createUpdate');
Route::post('/documents-admin/delete', 'DocumentsAdminController@deleteDoc');

//Training Routes:
Route::get('/alltrainings', 'TrainingsController@getOfferedTrainings');
Route::get('/viewtraining/{no}', 'TrainingsController@viewTraining');
Route::post('/registertraining', 'TrainingsController@registertraining');
Route::post('/add-attendee', 'TrainingsController@addAttendee');
Route::get('/mytrainings', 'TrainingsController@getMyTrainings');
Route::get('/mytrainingdetails/{no}', 'TrainingsController@myTrainingDetails');
// new
Route::post('/register-new-training', 'TrainingsController@RegisterNewTraining');
Route::post('/post-attendee-invoice', 'TrainingsController@GetAttendeeInvoice');
Route::post('/upload-lpo', 'TrainingsController@UploadAttachedDocument');

//Services Routes:
Route::get('/newservice', 'ServicesController@requestService');
Route::get('/servicedetails/{no?}', 'ServicesController@serviceDetails');
Route::get('/servicelines/{no}', 'ServicesController@serviceLines');
Route::get('/myservices/{status?}', 'ServicesController@getservices');
Route::get('/newinquiry', 'ServicesController@newInquiry');
Route::get('/inquire', 'ServicesController@inquire');
Route::get('/serviceValues/{service?}', 'ServicesController@serviceValues');

//FAQS Routes:
Route::get('/faqs', 'FaqController@getFaqs');

//Downloads Routes:
Route::get('/alldownloads', 'DownloadsController@allDownloads');
Route::get('/mydownloads', 'DownloadsController@myDownloads');
Route::get('/download/{id}/{type}/{ext}', 'DownloadsController@getAttachment');
Route::get('/singleDownload/{id}/{type}/', 'DownloadsController@singleDownload');
Route::get('/results/{ext}', 'DownloadsController@searchResults');
Route::post('/SearchContent', 'DownloadsController@SearchContent');
Route::get('/document-attachment/view/{id}/{name}/{type}', 'DownloadsController@ViewDocumentAttachment');

//Profile:
Route::get('/myprofile', 'UsersController@myProfile');
Route::get('/contact', 'UsersController@Contact');
Route::post('/mailNotify', 'UsersController@mailNotify');
Route::post('/updateprofile', 'UsersController@updateProfile');
Route::post('/updatepassword', 'UsersController@updatePassword');
Route::get('/downloadCertificate/{membno}', 'UsersController@downloadCertificate');

//Payment Routes:
Route::get('/paymentgateway/{Total_Payable?}', 'PaymentsController@paymentGateway');
Route::get('/paymentregistration', 'PaymentsController@paymentRegistration');

//Financials Routes:
Route::get('/quotations', 'FinancialsController@getQuotations');
Route::get('/financials', 'FinancialsController@getFinancials');
Route::get('/receipts', 'FinancialsController@receipts');
Route::get('/statement', 'FinancialsController@statement');
Route::get('/getStatement/{custno}','FinancialsController@getStatement');
Route::get('/downloadinvoice/{invoiceno}','FinancialsController@downloadinvoice');
Route::get('/downloadreceipt/{rcptno}','FinancialsController@downloadreceipt');
Route::post('/claimPayment','FinancialsController@claimPayment'); 
Route::post('/claimPaymentB4Login','FinancialsController@claimPaymentB4Login'); 


//Appointments Routes:
Route::get('/newappointments', 'AppointmentsController@getNew');
Route::get('/Rescheduledappointments', 'AppointmentsController@Rescheduled');
Route::get('/createappointment', 'AppointmentsController@createAppointment');
Route::get('/allappointments', 'AppointmentsController@getAppointments');
Route::get('/viewappointment/{no}', 'AppointmentsController@viewAppointment');
Route::get('/confirmappointment/{no}/{date}', 'AppointmentsController@confirmappointment');
Route::get('/cancelappointment/{no}/{date}', 'AppointmentsController@cancelappointment');

//Cases:
Route::get('/cases', 'CasesController@getMyCases');
Route::get('/MyCaseDetails/{no}', 'CasesController@Casedetails');
//documents
Route::get('/fke-document', 'DocumentsController@index');
Route::get('/fke-document/{no}', 'DocumentsController@show');

/** View Composer: */
view()->composer(['*'], function ($view) {
    $user = session()->all(); //Customer::where('No_','=',session('member_no'))->first();
    //dd($user);
    $view->with('user',$user);
});