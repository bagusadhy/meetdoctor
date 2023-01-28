<?php

// master data
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\ConsultationController as ConsultationBacksiteController;
use App\Http\Controllers\Backsite\SpecialistController;
use App\Http\Controllers\Backsite\ConfigPaymentController;

// operational
use App\Http\Controllers\Backsite\DoctorController;
use App\Http\Controllers\Backsite\AppointmentController as AppointmentBacksiteController;
use App\Http\Controllers\Backsite\TransactionController;
use App\Http\Controllers\Backsite\ReportController;

// management access
use App\Http\Controllers\Backsite\PermissionController;
use App\Http\Controllers\Backsite\RoleController;
use App\Http\Controllers\Backsite\UserController;
use App\Http\Controllers\Backsite\UserTypeController;

// frontsite
use App\Http\Controllers\Frontsite\AppointmentController;
use App\Http\Controllers\Frontsite\LandingController;
use App\Http\Controllers\Frontsite\PaymentController;

// auth
use App\Http\Controllers\Auth\SocialAuthController;
use App\Models\Operational\Appointment;;

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

Route::resource('/', LandingController::class);

// socialite routes
Route::get('sign-in-google', [SocialAuthController::class, 'google'])->name('user.login.google');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('google.user.callback');


// midtrans routes
Route::get('payment/success', [AppointmentController::class, 'midtransCallback']);
Route::post('payment/success', [AppointmentController::class, 'midtransCallback']);


// route for fronsite
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // appointment page
    Route::get('appointment/doctor/{id}', [AppointmentController::class, 'appointment'])->name('appointment.doctor');
    Route::resource('user_appointment', AppointmentController::class);

    // payment page
    Route::get('payment/transaction/{id}', [PaymentController::class, 'transaction'])->name('payment.transaction');
    Route::get('payment/appointment/{id}', [PaymentController::class, 'payment'])->name('payment.appointment');
    Route::resource('payment', PaymentController::class);
});


// route for backsite
Route::prefix('backsite')->middleware(['auth:sanctum', 'verified'])->group(function () {

    // dashboard route
    Route::resource('dashboard', DashboardController::class);

    // master-data route
    Route::resource('consultation', ConsultationBacksiteController::class);
    Route::resource('specialist', SpecialistController::class);
    Route::resource('config-payment', ConfigPaymentController::class);

    // operational route
    Route::resource('appointment', AppointmentBacksiteController::class);
    Route::resource('doctor', DoctorController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('report', ReportController::class);

    // management access route
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('user_type', UserTypeController::class);
});













// Route::get('/', function () {
//     return view('welcome');
// });


// Route::resource('/', LandingController::class);

// Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

//     // appointment page
//     Route::resource('appointment', AppointmentController::class);

//     // payment page
//     Route::resource('payment', PaymentController::class);
// });

// Route::group(['prefix' => 'backsite', 'as' => 'backsite.', 'middleware' => ['auth:sanctum', 'verified']], function () {
//     return view('welcome');
// });



// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
