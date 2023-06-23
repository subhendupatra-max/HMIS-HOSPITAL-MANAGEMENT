<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Master\ItemCategory\ItemCategoryApi;
use App\Http\Controllers\Master\ItemCategoryController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookingAppointmentController;
use App\Http\Controllers\API\ReportsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTH RELATED ROUTE

// LOGIN USER
Route::post('/login', [AuthController::class, 'loginUser']);


// LOGOUT USER
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::group(['middleware' => ['auth:sanctum', 'permission:add item categories']], function () {

    Route::get('/itemCategoryViewApi', [ItemCategoryApi::class, 'itemCategoryViewApi'])->name('itemCategoryViewApi');
    Route::get('/itemCategoryViewByIdApi/{id}', [ItemCategoryApi::class, 'itemCategoryViewByIdApi'])->name('itemCategoryViewByIdApi');
});

// ITEM CATEGORY ADD ROUTES 
Route::group(['middleware' => ['auth:sanctum', 'permission:add item categories']], function () {

    Route::post('/itemCategoryAddAction', [ItemCategoryApi::class, 'itemCategoryAddAction'])->name('itemCategoryAddAction');
});




// ------- Booking Appointment ------
Route::get('all-department-list', [BookingAppointmentController::class, 'all_department_list'])->name('all-department-list');

Route::get('/doctor-list', [BookingAppointmentController::class, 'doctor_list'])->name('doctor-list');
// ------- end Booking Appointment ------

// --------- staff ----------------
Route::get('fetch-all-staff-data', [BookingAppointmentController::class, 'fetch_all_staff'])->name('fetch-all-staff-data');

// --------- end staff ----------------

// ------------ reports  ---------------
Route::get('opd-patient-reports-index', [ReportsController::class, 'opd_patient_report_index'])->name('opd-patient-reports-index');

Route::post('opd-patient-reports', [ReportsController::class, 'opd_patient_report'])->name('opd-patient-reports');

Route::post('opd-billing-reports', [ReportsController::class, 'opd_billing_report'])->name('opd-billing-reports');

Route::get('emg-patient-report', [ReportsController::class, 'emg_patient_index'])->name('emg-patient-report');
Route::post('fetch-emg-patient-report', [ReportsController::class, 'fetch_emg_patient_report'])->name('fetch-emg-patient-report');


// ------------ reports  ---------------
