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

// User Details Permission
Route::post('/user-details', [AuthController::class, 'loginUserDetais']);

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


// --------- staff ----------------
Route::group(['middleware' => ['auth:sanctum']], function () {
    // ------- Booking Appointment ------
    Route::get('all-department-list', [BookingAppointmentController::class, 'all_department_list'])->name('all-department-list');

    Route::get('/doctor-list', [BookingAppointmentController::class, 'doctor_list'])->name('doctor-list');
    // ------- end Booking Appointment ------
    Route::get('fetch-all-staff-data', [BookingAppointmentController::class, 'fetch_all_staff'])->name('fetch-all-staff-data');
});

// --------- end staff ----------------

// ------------ reports  ---------------
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::group(['middleware' => ['permission:OPD Patient Report']], function () {
        Route::get('opd-patient-reports-index', [ReportsController::class, 'opd_patient_report_index'])->name('opd-patient-reports-index');
        Route::post('opd-patient-reports', [ReportsController::class, 'opd_patient_report'])->name('opd-patient-reports');
    });


    //for opd billing report
    Route::group(['middleware' => ['permission:OPD Billing Report']], function () {
        Route::post('opd-billing-reports', [ReportsController::class, 'opd_billing_report'])->name('opd-billing-reports');
    });


    //for emg patient report
    Route::group(['middleware' => ['permission:EMG Patient Report']], function () {
        Route::get('emg-patient-report', [ReportsController::class, 'emg_patient_index'])->name('emg-patient-report');
        Route::post('fetch-emg-patient-report', [ReportsController::class, 'fetch_emg_patient_report'])->name('fetch-emg-patient-report');
    });

    //for emg billing report
    Route::group(['middleware' => ['permission:EMG Billing Report']], function () {
        Route::post('fetch-emg-billing-report', [ReportsController::class, 'fetch_emg_billing_report'])->name('fetch-emg-billing-report');
    });

    //for ipd patient report
    Route::group(['middleware' => ['permission:IPD Patient Report']], function () {
        Route::get('ipd-patient-report', [ReportsController::class, 'ipd_patient_index'])->name('ipd-patient-report');

        Route::post('fetch-ipd-patient-report', [ReportsController::class, 'fetch_ipd_patient_report'])->name('fetch-ipd-patient-report');
    });


    //for ipd billing report
    Route::group(['middleware' => ['permission:IPD Billing Report']], function () {
        Route::post('fetch-ipd-billing-report', [ReportsController::class, 'fetch_ipd_billing_report'])->name('fetch-ipd-billing-report');
    });

    //for payment report
    Route::group(['middleware' => ['permission:Payment Report']], function () {
        Route::get('payment-report', [ReportsController::class, 'payment_report_index'])->name('payment-report');
        Route::post('fetch-payment-report', [ReportsController::class, 'fetch_payment_report'])->name('fetch-payment-report');
    });


    //for discharge patient report
    Route::group(['middleware' => ['permission:Discharge Patient Report']], function () {
        Route::get('discharge-patient-report', [ReportsController::class, 'discharge_patient_report_index'])->name('discharge-patient-report');
        Route::post('fetch-discharge-patient-report', [ReportsController::class, 'fetch_discharge_patient_report'])->name('fetch-discharge-patient-report');
    });

    //for pharmacy bill report
    Route::group(['middleware' => ['permission:Pharmacy Bill Report']], function () {
        Route::get('pharmacy-bill-report', [ReportsController::class, 'pharmacy_bill_report_index'])->name('pharmacy-bill-report');
        Route::post('fetch-pharmacy-bill-report', [ReportsController::class, 'fetch_pharmacy_bill_report'])->name('fetch-pharmacy-bill-report');
    });

    //for operation report
    Route::group(['middleware' => ['permission:Operaiton Report']], function () {
        Route::get('operation-report', [ReportsController::class, 'operation_report_index'])->name('operation-report');
        Route::post('fetch-operation-report', [ReportsController::class, 'fetch_operation_report'])->name('fetch-operation-report');
    });

    //for blood issue report
    Route::group(['middleware' => ['permission:Blood Issue Report']], function () {
        Route::get('blood-issue-report', [ReportsController::class, 'blood_issue_report_index'])->name('blood-issue-report');
        Route::post('fetch-blood-issue-report', [ReportsController::class, 'fetch_blood_issue_report'])->name('fetch-blood-issue-report');
    });

    //for blood components issue report
    Route::group(['middleware' => ['permission:Blood Components Issue Report']], function () {
        Route::get('blood-components-issue-report', [ReportsController::class, 'blood_components_issue_report_index'])->name('blood-components-issue-report');
        Route::post('fetch-blood-components-issue-report', [ReportsController::class, 'fetch_blood_components_issue_report'])->name('fetch-blood-components-issue-report');
    });
    //for blood donor report
    Route::group(['middleware' => ['permission:Blood Donor Report']], function () {
        Route::get('blood-donor-details', [ReportsController::class, 'blood_donor_details'])->name('blood-donor-details');
        Route::post('fetch-blood-donor-details', [ReportsController::class, 'fetch_blood_donor_details'])->name('fetch-blood-donor-details');
    });
    //for death report
    Route::group(['middleware' => ['permission:Death Report']], function () {
        Route::post('fetch-patient-death-details', [ReportsController::class, 'fetch_patient_death_details'])->name('fetch-patient-death-details');
    });

    //for Referral Report
    Route::group(['middleware' => ['permission:Referral Report']], function () {
        Route::get('referral-details-report', [ReportsController::class, 'referral_details_report'])->name('referral-details-report');
        Route::post('fetch-referral-payment-report', [ReportsController::class, 'fetch_referral_payment_report'])->name('fetch-referral-payment-report');
    });
});


// ------------ reports  ---------------
