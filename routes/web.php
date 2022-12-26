<?php

use App\Http\Controllers\Backsite\DashboardController;

use App\Http\Controllers\Frontsite\AppointmentController;
use App\Http\Controllers\Frontsite\LandingController;
use App\Http\Controllers\Frontsite\PaymentController;
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

// route for fronsite
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // appointment page
    Route::resource('appointment', AppointmentController::class);

    // payment page
    Route::resource('payment', PaymentController::class);
});


// route for backsite
Route::prefix('backsite')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
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
