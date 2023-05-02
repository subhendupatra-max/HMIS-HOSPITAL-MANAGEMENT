<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Permission\PermissionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrefixController;
use App\Http\Controllers\Bed\BedController;
use App\Http\Controllers\BedUnitController;
use App\Http\Controllers\BedTypeController;
use App\Http\Controllers\Bed\FloorController;
use App\Http\Controllers\Bed\WardController;
use App\Http\Controllers\BedGroupController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\charges\ChargeController;
use App\Http\Controllers\ChargesCatagoryController;
use App\Http\Controllers\ChargesSubCatagoryController;
use App\Http\Controllers\ChargesUnitController;
use App\Http\Controllers\AllHeaderController;
use App\Http\Controllers\OperationCatagoryController;
use App\Http\Controllers\OperationTypeController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\SymptomsController;
use App\Http\Controllers\DiagonasisController;
use App\Http\Controllers\TpaManagemnetController;
use App\Http\Controllers\bloodBank\ProductController;
use App\Http\Controllers\shift\ShiftController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\OPD\OpdController;
use App\Http\Controllers\FindingController;

use App\Http\Controllers\PathologyController;
use App\Http\Controllers\pathology\PathologyCatagoryController;
use App\Http\Controllers\pathology\PathologyUnitController;
use App\Http\Controllers\pathology\PathologyParameterController;

use App\Http\Controllers\radiology\RadiologyController;
use App\Http\Controllers\radiology\RadiologyCatagoryController;
use App\Http\Controllers\radiology\RadiologyUnitController;
use App\Http\Controllers\radiology\RadiologyParameterController;

use App\Http\Controllers\ambulance\AmbulanceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Emg\EmgController;
use App\Http\Controllers\PostalController;
use App\Http\Controllers\DispatchController;

use App\Http\Controllers\VisitController;
use App\Http\Controllers\ComplainController;

use App\Http\Controllers\IpdController;
use App\Http\Controllers\TimelineController;

use App\Http\Controllers\pharmacy\MedicineCatagoryController;
use App\Http\Controllers\pharmacy\MedicineUnitController;
use App\Http\Controllers\pharmacy\MedicineDosageController;
use App\Http\Controllers\pharmacy\SupplierController;
use App\Http\Controllers\pharmacy\DoseIntervalController;
use App\Http\Controllers\pharmacy\DoseDurationController;
use App\Http\Controllers\pharmacy\MedicineController;
use App\Http\Controllers\pharmacy\PharmacyController;
use App\Http\Controllers\BedTransfarController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\NurseNoteController;
use App\Http\Controllers\OxygenMonitoringController;
use App\Http\Controllers\OperationTheatreController;
use App\Http\Controllers\IpdPaymentController;
use App\Http\Controllers\IpdChargeController;

use App\Http\Controllers\ChargesPackageCatagoryController;
use App\Http\Controllers\ChargesPackageSubCatagoryController;
use App\Http\Controllers\ChargesPackageNameController;
use App\Http\Controllers\OpdPaymentController;
use App\Http\Controllers\EmgPaymentController;

use App\Http\Controllers\MedcineStoreController;
use App\Http\Controllers\MedcineRackController;
use App\Http\Controllers\MedicineRequisitionController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\MedicineStoreRoomController;

use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\GRNController;

use App\Http\Controllers\setup_Inventory\ItemCatagoryController;
use App\Http\Controllers\setup_Inventory\ItemBrandController;
use App\Http\Controllers\setup_Inventory\ManufactureController;
use App\Http\Controllers\setup_Inventory\ItemTypeController;
use App\Http\Controllers\setup_Inventory\ItemStoreRoomController;
use App\Http\Controllers\setup_Inventory\ItemAttributeController;
use App\Http\Controllers\setup_Inventory\ItemController;
use App\Http\Controllers\setup_Inventory\ItemUnitController;

use App\Http\Controllers\Inventory\ItemStockController;
use App\Http\Controllers\Inventory\ItemRequisitionController;
use App\Http\Controllers\InventoryVendorController;

use App\Http\Controllers\bloodBank\BloodBankController;
use App\Http\Controllers\bloodBank\BloodDonorController;
use App\Http\Controllers\bloodBank\BloodBPosetiveController;
use App\Http\Controllers\bloodBank\UnitTypeController;
use App\Http\Controllers\bloodBank\ComponentsController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\front_office\PurposeController;
use App\Http\Controllers\front_office\ComplainTypeController;
use App\Http\Controllers\front_office\SourceController;
use App\Http\Controllers\OPD\BillingController;

use App\Http\Controllers\PhysicalConditionController;

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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('appPages/dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

// USER BASED PERMISSION RELATED ROUTES

Route::group(['middleware' => ['permission:asign userBasedPermission']], function () {

    Route::get('/user-permissionAsign-list', [PermissionController::class, 'userPermissionAsignList',])->middleware(['auth'])->name('userPermissionAsignList');
    Route::get('/permission-asign-to-user/{role}', [PermissionController::class, 'PermissionAsignToUser'])->name('PermissionAsignToUser');
    Route::post('/asign-permission-to-user', [PermissionController::class, 'PermissionAsignToUserAction'])->name('PermissionAsignToUserAction');
});


// ROLE BASED PERMISSION RELATED ROUTES
Route::group(['middleware' => ['permission:asign roleBasedPermission']], function () {

    Route::get('/permission-asign/{role}', [PermissionController::class, 'PermissionAsign'])->name('PermissionAsign');
    Route::post('/asign-permission', [PermissionController::class, 'asignPermission'])->name('asignPermission');
});


//================================ROLE=============================
// VIEW ROLE
Route::group(['middleware' => ['permission:view role']], function () {

    Route::get('/role-list', [RoleController::class, 'index'])->name('roleList');
});

// ADD ROLE
Route::group(['middleware' => ['permission:add role']], function () {

    Route::post('/add-role', [RoleController::class, 'addRole'])->name('addRole');
});
// DELETE ROLE
Route::group(['middleware' => ['permission:delete role']], function () {

    Route::post('/delete-role', [RoleController::class, 'deleteRole'])->name('deleteRole');
});
// EDIT ROLE
Route::group(['middleware' => ['permission:edit role']], function () {

    Route::get('/edit-role/{id}', [RoleController::class, 'editRole'])->name('editRole');
    Route::post('/edit-role-action', [RoleController::class, 'editRoleAction'])->name('editRoleAction');
});
//================================ROLE=============================

// ROLE ASIGNMENT TO USER RELATED ROUTES

Route::group(['middleware' => ['permission:asign roleToUser|revoke roleToUser']], function () {

    Route::get('/asign-role', [RoleController::class, 'asignRole'])->name('asignRole');
});

Route::group(['middleware' => ['permission:asign roleToUser']], function () {

    Route::post('/asign-role-action', [RoleController::class, 'asignRoleAction'])->name('asignRoleAction');
});

// ROLE REVOKE TO USER RELATED ROUTES
Route::group(['middleware' => ['permission:revoke roleToUser']], function () {

    Route::post('/revoke-role-action', [RoleController::class, 'revokeRoleAction'])->name('revokeRoleAction');
    Route::post('/usr-role-check', [RoleController::class, 'getRole'])->name('getRole');
});


//====================== PERMISSION =====================================
Route::group(['middleware' => ['permission:view permission']], function () {

    Route::get('/permission-list', [PermissionController::class, 'index'])->name('PermissionList');
});
// DELETE PERMISSION
Route::group(['middleware' => ['permission:delete permission']], function () {

    Route::post('/delete-permission', [PermissionController::class, 'deletePermission'])->name('deletePermission');
});
// ADD PERMISSION
Route::group(['middleware' => ['permission:add permission']], function () {

    Route::post('/add-permission', [PermissionController::class, 'addPermission'])->name('addPermission');
});
// EDIT PERMISSION
Route::group(['middleware' => ['permission:edit permission']], function () {

    Route::get('/permission-edit/{id}', [PermissionController::class, 'editPermission'])->name('permissionEdit');
    Route::post('/permission-edit-action', [PermissionController::class, 'editPermissionAction'])->name('permissionEditAction');
});
//====================== PERMISSION =====================================


// ======================================== User ==================================================
Route::group(['middleware' => ['permission:User']], function () {
    Route::group(['middleware' => ['permission:User Add']], function () {
        Route::get('/User-add', [UserController::class, 'UserCreate'])->name('UserCreate');
        Route::post('/UserCreateAction', [UserController::class, 'UserCreateAction'])->name('UserCreateAction');
    });
    Route::group(['middleware' => ['permission:User List']], function () {
        Route::get('/user-list', [UserController::class, 'userlist'])->name('user-list');
    });
    Route::group(['middleware' => ['permission:user profile']], function () {
        Route::get('/user-profile/{id?}', [UserController::class, 'userprofile'])->name('user-profile');
    });
    Route::group(['middleware' => ['permission:user delete']], function () {
        Route::get('/user-delete/{id?}', [UserController::class, 'user_delete'])->name('user-delete');
    });
    Route::group(['middleware' => ['permission:user active deactive']], function () {
        Route::get('/user-enable-disable/{id?}', [UserController::class, 'user_enable_disable'])->name('user-enable-disable');
    });
    Route::group(['middleware' => ['permission:Change Password']], function () {
        Route::get('change-password', [UserController::class, 'change_password'])->name('change-password');
        Route::post('save-change-password', [UserController::class, 'save_change_password'])->name('save-change-password');
    });
    Route::group(['middleware' => ['permission:user edit']], function () {
        Route::get('user-edit/{id?}', [UserController::class, 'user_edit'])->name('user-edit');
        Route::post('user-update', [UserController::class, 'user_update'])->name('user-update');
    });
});
// ======================================== User ==================================================


// ======================================== Set Up =========================================
Route::group(['middleware' => ['permission:Set Up']], function () {
    // ====================== General Setting ==================
    Route::group(['middleware' => ['permission:General Setting']], function () {
        Route::get('general-setting-details', [SettingController::class, 'general_setting_details'])->name('general_setting_details');
        Route::post('save-general-setting', [SettingController::class, 'save_general_setting'])->name('save-general-setting');
    });
    // ====================== General Setting ==================


    // ====================== Charges ==================
    Route::group(['middleware' => ['permission:Charges Master']], function () {

        // ==================================charges sub menu =================
        Route::group(['middleware' => ['permission:charges']], function () {
            Route::get('charges-details', [ChargeController::class, 'charges_details'])->name('charges-details');
            Route::group(['middleware' => ['permission:add charges']], function () {
                Route::get('charges-add', [ChargeController::class, 'charges_add'])->name('charges-add');
                Route::post('save-charges-details', [ChargeController::class, 'save_charges_details'])->name('save-charges-details');
            });
            Route::group(['middleware' => ['permission:delete charges']], function () {
                Route::get('delete-charges-details/{id}', [ChargeController::class, 'delete_charges_details'])->name('delete-charges-details');
            });
            Route::group(['middleware' => ['permission:edit charges']], function () {
                Route::get('edit-charges-details/{id}', [ChargeController::class, 'edit_charges_details'])->name('edit-charges-details');
                Route::post('update-charges-details', [ChargeController::class, 'update_charges_details'])->name('update-charges-details');
            });
        });
        // ==================================charges sub menu =================

        // ==================================charges catagory =================
        Route::group(['middleware' => ['permission:charges catagory']], function () {

            Route::group(['middleware' => ['permission:charges add catagory']], function () {
                Route::get('charges-catagory-details', [ChargesCatagoryController::class, 'charges_catagory_details'])->name('charges-catagory-details');
                Route::post('save-charges-catagory-details', [ChargesCatagoryController::class, 'save_charges_catagory_details'])->name('save-charges-catagory-details');
            });
            Route::group(['middleware' => ['permission:charges delete catagory']], function () {
                Route::get('delete-charges-catagory-details/{id}', [ChargesCatagoryController::class, 'delete_charges_catagory_details'])->name('delete-charges-catagory-details');
            });
            Route::group(['middleware' => ['permission:charges edit catagory']], function () {
                Route::get('edit-charges-catagory-details/{id}', [ChargesCatagoryController::class, 'edit_charges_catagory_details'])->name('edit-charges-catagory-details');
                Route::post('update-charges-catagory-details', [ChargesCatagoryController::class, 'update_charges_catagory_details'])->name('update-charges-catagory-details');
            });
        });
        // ==================================charges catagory =================

        // ==================================charges sub catagory =================
        Route::group(['middleware' => ['permission:charges sub catagory']], function () {

            Route::group(['middleware' => ['permission:charges add sub catagory']], function () {
                Route::get('charges-sub-catagory-details', [ChargesSubCatagoryController::class, 'charges_sub_catagory_details'])->name('charges-sub-catagory-details');
                Route::post('save-charges-sub-catagory-details', [ChargesSubCatagoryController::class, 'save_charges_sub_catagory_details'])->name('save-charges-sub-catagory-details');
            });
            Route::group(['middleware' => ['permission:charges delete sub catagory']], function () {
                Route::get('delete-charges-sub-catagory-details/{id}', [ChargesSubCatagoryController::class, 'delete_charges_sub_catagory_details'])->name('delete-charges-sub-catagory-details');
            });
            Route::group(['middleware' => ['permission:charges edit sub catagory']], function () {
                Route::get('edit-charges-sub-catagory-details/{id}', [ChargesSubCatagoryController::class, 'edit_charges_sub_catagory_details'])->name('edit-charges-sub-catagory-details');
                Route::post('update-charges-sub-catagory-details', [ChargesSubCatagoryController::class, 'update_charges_sub_catagory_details'])->name('update-charges-sub-catagory-details');
            });
        });
        // ==================================charges sub catagory =================


        // ==================================charges unit =================
        Route::group(['middleware' => ['permission:charges unit']], function () {

            Route::group(['middleware' => ['permission:charges add unit']], function () {
                Route::get('charges-unit-details', [ChargesUnitController::class, 'charges_unit_details'])->name('charges-unit-details');
                Route::post('save-charges-unit-details', [ChargesUnitController::class, 'save_charges_unit_details'])->name('save-charges-unit-details');
            });
            Route::group(['middleware' => ['permission:charges delete unit']], function () {
                Route::get('delete-charges-unit-details/{id}', [ChargesUnitController::class, 'delete_charges_unit_details'])->name('delete-charges-unit-details');
            });
            Route::group(['middleware' => ['permission:charges edit unit']], function () {
                Route::get('edit-charges-unit-details/{id}', [ChargesUnitController::class, 'edit_charges_unit_details'])->name('edit-charges-unit-details');
                Route::post('update-charges-unit-details', [ChargesUnitController::class, 'update_charges_unit_details'])->name('update-charges-unit-details');
            });
        });
        // ==================================charges unit =================
    });
    // ====================== Charges ==================

    // ====================== All Header ==================
    Route::group(['middleware' => ['permission:']], function () {
        Route::get('all-header-listing', [AllHeaderController::class, 'all_header_listing'])->name('all-header-listing');
        Route::get('all-header-details/{id}', [AllHeaderController::class, 'all_header_details'])->name('all-header-details');
        Route::post('save-all-header-details', [AllHeaderController::class, 'save_all_header_details'])->name('save-all-header-details');
    });
    // ====================== All Header ==================

    // ====================== Patient Details  ==================
    Route::group(['middleware' => ['permission:Patient Master']], function () {
        Route::get('patient-list', [PatientController::class, 'patient_details'])->name('patient_details');
    });
    Route::group(['middleware' => ['permission:add patient']], function () {
        Route::get('add-new-patient', [PatientController::class, 'add_new_patient'])->name('add_new_patient');
        Route::post('submit_new_patient_details', [PatientController::class, 'submit_new_patient_details'])->name('submit_new_patient_details');
    });
    Route::group(['middleware' => ['permission:import patient']], function () {
        Route::get('import-patient', [PatientController::class, 'import_patient'])->name('import-patient');
        Route::post('upload-import-patient', [PatientController::class, 'upload_import_patient'])->name('upload-import-patient');
    });

    Route::get('view-new-patient/{id}', [PatientController::class, 'view_new_patient'])->name('view-new-patient');

    //show patient detils
    Route::get('patient-details-profile/{id}', [PatientController::class, 'view_patient_details'])->name('patient-details-profile');


    Route::group(['middleware' => ['permission:edit patient']], function () {
        Route::get('edit-new-patient/{id}', [PatientController::class, 'edit_new_patient'])->name('edit-patient-details');
        Route::get('edit-new-patient-opd/{id}', [PatientController::class, 'edit_opd_new_patient'])->name('edit-new-patient-opd');
        Route::get('edit-patient-details-emg/{id}', [PatientController::class, 'edit_emg_new_patient'])->name('edit-patient-details-emg');
        Route::post('update-new-patient-details', [PatientController::class, 'update_new_patient_details'])->name('update-new-patient-details');
        Route::post('update-new-patient-details-opd', [PatientController::class, 'update_new_patient_details_opd'])->name('update-new-patient-details-opd');
        Route::post('update-new-patient-details-emg', [PatientController::class, 'update_new_patient_details_emg'])->name('update-new-patient-details-emg');
    });

    Route::group(['middleware' => ['permission:delete patient']], function () {
        Route::get('delete-patient-details/{id}', [PatientController::class, 'delete'])->name('delete-patient-details');
    });
    Route::group(['middleware' => ['permission:search patient']], function () {
        Route::post('get-patient-serach', [PatientController::class, 'search_patient'])->name('get-patient-serach');
    });
    Route::post('find-fr-district-by-state', [PatientController::class, 'find_fr_district_by_state'])->name('find-fr-district-by-state');

    Route::post('find-state-by-country', [PatientController::class, 'find_state_by_country'])->name('find-state-by-country');

    Route::post('find-local-state-by-country', [PatientController::class, 'find_state_by_country'])->name('find-local-state-by-country');

    Route::post('find-local-state-by-country', [PatientController::class, 'find_local_state_by_country'])->name('find-local-state-by-country');

    Route::post('find-local-district-by-state', [PatientController::class, 'find_local_district_by_state'])->name('find-local-district-by-state');
    // ====================== Patient Details ==================

    // ==================================prefix=================
    Route::group(['middleware' => ['permission:prefix']], function () {
        Route::group(['middleware' => ['permission:view prefix']], function () {
            Route::get('/prefixList', [PrefixController::class, 'prefixList'])->name('prefixList');
        });
        Route::group(['middleware' => ['permission:add prefix']], function () {
            Route::post('/addPrefix', [PrefixController::class, 'addPrefix'])->name('addPrefix');
        });
        Route::group(['middleware' => ['permission:delete prefix']], function () {
            Route::post('/deletePrefix', [PrefixController::class, 'deletePrefix'])->name('deletePrefix');
        });
        Route::group(['middleware' => ['permission:edit prefix']], function () {
            Route::get('/editPrefix/{id}', [PrefixController::class, 'prefixEdit'])->name('editPrefix');
            Route::post('/prefixEditAction', [PrefixController::class, 'prefixEditAction'])->name('prefixEditAction');
        });
    });
    // ==================================prefix=======================

    // ==================================Department=================
    Route::group(['middleware' => ['permission:Department']], function () {
        Route::group(['middleware' => ['permission:add department']], function () {
            Route::get('department-details', [DepartmentController::class, 'department_details'])->name('department-details');
            Route::post('save-department-details', [DepartmentController::class, 'save_department_details'])->name('save-department-details');
        });
        Route::group(['middleware' => ['permission:delete department']], function () {
            Route::get('delete-department-details/{id}', [DepartmentController::class, 'delete_department_details'])->name('delete-department-details');
        });
        Route::group(['middleware' => ['permission:edit department']], function () {
            Route::get('edit-department-details/{id}', [DepartmentController::class, 'edit_department_details'])->name('edit-department-details');
            Route::post('update-department-details', [DepartmentController::class, 'update_department_details'])->name('update-department-details');
        });
    });
    // ================================== Department=================

    // ==================================bedMaster=================

    Route::group(['middleware' => ['permission:Bed Master']], function () {

        // ==================================bed=================
        Route::group(['middleware' => ['permission:bed']], function () {

            Route::group(['middleware' => ['permission:add bed']], function () {
                Route::get('bed-details', [BedController::class, 'bed_details'])->name('bed-details');
                Route::post('save-bed-details', [BedController::class, 'save_bed_details'])->name('save-bed-details');
            });
            Route::group(['middleware' => ['permission:delete bed']], function () {
                Route::get('delete-bed-details/{id}', [BedController::class, 'delete_bed_details'])->name('delete-bed-details');
            });
            Route::group(['middleware' => ['permission:edit bed']], function () {
                Route::get('edit-bed-details/{id}', [BedController::class, 'edit_bed_details'])->name('edit-bed-details');
                Route::post('update-bed-details', [BedController::class, 'update_bed_details'])->name('update-bed-details');
            });
        });
        // ==================================bed=================

        // ==================================bedUnit=================
        Route::group(['middleware' => ['permission:bedUnit']], function () {
            Route::group(['middleware' => ['permission:add bed unit']], function () {
                Route::get('bed-unit-details', [BedUnitController::class, 'bedUnit_details'])->name('bed-unit-details');
                Route::post('save-bed-unit-details', [BedUnitController::class, 'save_bed_unit_details'])->name('save-bed-unit-details');
            });
            Route::group(['middleware' => ['permission:delete bed unit']], function () {
                Route::get('delete-bed-unit-details/{id}', [BedUnitController::class, 'delete_bed_unit_details'])->name('delete-bed-unit-details');
            });
            Route::group(['middleware' => ['permission:edit bed unit']], function () {
                Route::get('edit-bed-unit-details/{id}', [BedUnitController::class, 'edit_bed_unit_details'])->name('edit-bed-unit-details');
                Route::post('update-bed-unit-details', [BedUnitController::class, 'update_bed_unit_details'])->name('update-bed-unit-details');
            });
        });
        // ==================================bedUnit=================

        // ==================================bedType=================
        Route::group(['middleware' => ['permission:bed type']], function () {
            Route::group(['middleware' => ['permission:add bed type']], function () {
                Route::get('bed-type-details', [BedTypeController::class, 'bedType_details'])->name('bed-type-details');
                Route::post('save-bed-type-details', [BedTypeController::class, 'save_bed_type_details'])->name('save-bed-type-details');
            });
            Route::group(['middleware' => ['permission:delete bed type']], function () {
                Route::get('delete-bed-type-details/{id}', [BedTypeController::class, 'delete_bed_type_details'])->name('delete-bed-type-details');
            });
            Route::group(['middleware' => ['permission:edit bed type']], function () {
                Route::get('edit-bed-type-details/{id}', [BedTypeController::class, 'edit_bed_type_details'])->name('edit-bed-type-details');
                Route::post('update-bed-type-details', [BedTypeController::class, 'update_bed_type_details'])->name('update-bed-type-details');
            });
        });
        // ==================================bedType=================

        // ==================================floor=================
        Route::group(['middleware' => ['permission:floor']], function () {
            Route::group(['middleware' => ['permission:add floor']], function () {
                Route::get('floor-details', [FloorController::class, 'floor_details'])->name('floor-details');
                Route::post('save-floor-details', [FloorController::class, 'save_floor_details'])->name('save-floor-details');
            });
            Route::group(['middleware' => ['permission:delete floor']], function () {
                Route::get('delete-floor-details/{id}', [FloorController::class, 'delete_floor_details'])->name('delete-floor-details');
            });
            Route::group(['middleware' => ['permission:edit floor']], function () {
                Route::get('edit-floor-details/{id}', [FloorController::class, 'edit_floor_details'])->name('edit-floor-details');
                Route::post('update-floor-details', [FloorController::class, 'update_floor_details'])->name('update-floor-details');
            });
        });
        // ==================================floor=================

        // ==================================ward=================
        Route::group(['middleware' => ['permission:ward']], function () {
            Route::group(['middleware' => ['permission:add ward']], function () {
                Route::get('ward-details', [WardController::class, 'ward_details'])->name('ward-details');
                Route::post('save-ward-details', [WardController::class, 'save_ward_details'])->name('save-ward-details');
            });
            Route::group(['middleware' => ['permission:delete ward']], function () {
                Route::get('delete-ward-details/{id}', [WardController::class, 'delete_ward_details'])->name('delete-ward-details');
            });
            Route::group(['middleware' => ['permission:edit ward']], function () {
                Route::get('edit-ward-details/{id}', [WardController::class, 'edit_ward_details'])->name('edit-ward-details');
                Route::post('update-ward-details', [WardController::class, 'update_ward_details'])->name('update-ward-details');
            });
        });
        // ==================================ward=================

        // ==================================bedgroup=================
        Route::group(['middleware' => ['permission:bedgroup']], function () {
            Route::group(['middleware' => ['permission:add bedgroup']], function () {
                Route::get('bedgroup-details', [BedGroupController::class, 'bedgroup_details'])->name('bedgroup-details');
                Route::post('save-bedgroup-details', [BedGroupController::class, 'save_bedgroup_details'])->name('save-bedgroup-details');
            });
            Route::group(['middleware' => ['permission:delete bedgroup']], function () {
                Route::get('delete-bedgroup-details/{id}', [BedGroupController::class, 'delete_bedgroup_details'])->name('delete-bedgroup-details');
            });
            Route::group(['middleware' => ['permission:edit bedgroup']], function () {
                Route::get('edit-bedgroup-details/{id}', [BedGroupController::class, 'edit_bedgroup_details'])->name('edit-bedgroup-details');
                Route::post('update-bedgroup-details', [BedGroupController::class, 'update_bedgroup_details'])->name('update-bedgroup-details');
            });
        });
        // ==================================bedgroup=================
    });

    // ================================== Operation Master =================
    Route::group(['middleware' => ['permission:Master Operation']], function () {

        // ================================== operation catagory =================
        Route::group(['middleware' => ['permission:operation catagory']], function () {

            Route::group(['middleware' => ['permission:add operation catagory']], function () {
                Route::get('operation_catagory_details', [OperationCatagoryController::class, 'operation_catagory_details'])->name('operation-catagory-details');
                Route::post('save-operation-catagory-details', [OperationCatagoryController::class, 'save_operation_catagory_details'])->name('save-operation-catagory-details');
            });
            Route::group(['middleware' => ['permission:delete operation catagory']], function () {
                Route::get('delete-operation-catagory-details/{id}', [OperationCatagoryController::class, 'delete_operation_catagory_details'])->name('delete-operation-catagory-details');
            });
            Route::group(['middleware' => ['permission:edit operation catagory']], function () {
                Route::get('edit-operation-catagory-details/{id}', [OperationCatagoryController::class, 'edit_operation_catagory_details'])->name('edit-operation-catagory-details');
                Route::post('update-operation-catagory-details', [OperationCatagoryController::class, 'update_operation_catagory_details'])->name('update-operation-catagory-details');
            });
        });
        // ================================== operation catagory =================

        // ================================== operation type =================
        Route::group(['middleware' => ['permission:operation type']], function () {

            Route::group(['middleware' => ['permission:add operation type']], function () {
                Route::get('operation_type_details', [OperationTypeController::class, 'operation_type_details'])->name('operation-type-details');
                Route::post('save-operation-type-details', [OperationTypeController::class, 'save_operation_type_details'])->name('save-operation-type-details');
            });
            Route::group(['middleware' => ['permission:delete operation type']], function () {
                Route::get('delete-operation-type-details/{id}', [OperationTypeController::class, 'delete_operation_type_details'])->name('delete-operation-type-details');
            });
            Route::group(['middleware' => ['permission:edit operation type']], function () {
                Route::get('edit-operation-type-details/{id}', [OperationTypeController::class, 'edit_operation_type_details'])->name('edit-operation-type-details');
                Route::post('update-operation-type-details', [OperationTypeController::class, 'update_operation_type_details'])->name('update-operation-type-details');
            });
        });
        // ================================== operation type =================

        // ================================== operation  =================
        Route::group(['middleware' => ['permission:operation']], function () {

            Route::group(['middleware' => ['permission:add operation']], function () {
                Route::get('operation-details', [OperationController::class, 'operation_details'])->name('operation-details');
                Route::post('save-operation-details', [OperationController::class, 'save_operation_details'])->name('save-operation-details');
            });
            Route::group(['middleware' => ['permission:delete operation']], function () {
                Route::get('delete-operation-details/{id}', [OperationController::class, 'delete_operation_details'])->name('delete-operation-details');
            });
            Route::group(['middleware' => ['permission:edit operation']], function () {
                Route::get('edit-operation-details/{id}', [OperationController::class, 'edit_operation_details'])->name('edit-operation-details');
                Route::post('update-operation-details', [OperationController::class, 'update_operation_details'])->name('update-operation-details');
            });
        });
        // ================================== operation  =================
    });
    // ================================== Operation Master =================

    // ====================== Opd ==================
    Route::group(['middleware' => ['permission:Opd']], function () {

        // ================================== Opd Unit =================
        Route::group(['middleware' => ['permission:opd unit']], function () {

            Route::group(['middleware' => ['permission:add opd unit']], function () {
                Route::get('opd-unit-details', [OpdController::class, 'opd_unit_details'])->name('opd-unit-details');
                Route::post('save-opd-unit-details', [OpdController::class, 'save_opd_unit_details'])->name('save-opd-unit-details');
            });
            Route::group(['middleware' => ['permission:delete opd unit']], function () {
                Route::get('delete-opd-unit-details/{id}', [OpdController::class, 'delete_opd_unit_details'])->name('delete-opd-unit-details');
            });
            Route::group(['middleware' => ['permission:edit opd unit']], function () {
                Route::get('edit-opd-unit-details/{id}', [OpdController::class, 'edit_opd_unit_details'])->name('edit-opd-unit-details');
                Route::post('update-opd-unit-details', [OpdController::class, 'update_opd_unit_details'])->name('update-opd-unit-details');
            });
        });
        // ==================================  Opd Unit  =================

        // ================================== Opd Setup =================
        Route::group(['middleware' => ['permission:opd setup']], function () {

            Route::group(['middleware' => ['permission:add opd setup']], function () {
                Route::get('opd-setup-details', [OpdController::class, 'opd_setup_details'])->name('opd-setup-details');
                Route::post('save-opd-setup-details', [OpdController::class, 'save_opd_setup_details'])->name('save-opd-setup-details');
            });
        });
        // ==================================  Opd Setup  =================

        // ================================== Opd Ticket Fees =================
        Route::group(['middleware' => ['permission:opd setup']], function () {

            Route::group(['middleware' => ['permission:add opd ticket fees']], function () {
                Route::get('opd-ticket-fees-details', [OpdController::class, 'opd_ticket_fees_details'])->name('opd-ticket-fees-details');
                Route::post('save-opd-ticket-fees-details', [OpdController::class, 'save_opd_ticket_fees_details'])->name('save-opd-ticket-fees-details');
            });
            Route::group(['middleware' => ['permission:delete opd ticket fees']], function () {
                Route::get('delete-opd-ticket-fees-details/{id}', [OpdController::class, 'delete_opd_ticket_fees_details'])->name('delete-opd-ticket-fees-details');
            });
            Route::group(['middleware' => ['permission:edit opd ticket fees']], function () {
                Route::get('edit-opd-ticket-fees-details/{id}', [OpdController::class, 'edit_opd_ticket_fees_details'])->name('edit-opd-ticket-fees-details');
                Route::post('update-opd-ticket-fees-details', [OpdController::class, 'update_opd_ticket_fees_details'])->name('update-opd-ticket-fees-details');
            });
        });
        // ==================================  Opd Ticket Fees  =================
    });
    // ==================================  Opd  =================

    // ====================== Symptoms ==================
    Route::group(['middleware' => ['permission:symptoms']], function () {

        // ================================== Symptoms Type =================
        Route::group(['middleware' => ['permission:symptoms type']], function () {

            Route::group(['middleware' => ['permission:add symptoms type']], function () {
                Route::get('symptoms-type-details', [SymptomsController::class, 'symptoms_type_details'])->name('symptoms-type-details');
                Route::post('save-symptoms-type-details', [SymptomsController::class, 'save_symptoms_type_details'])->name('save-symptoms-type-details');
            });
            Route::group(['middleware' => ['permission:delete symptoms type']], function () {
                Route::get('delete-symptoms-type-details/{id}', [SymptomsController::class, 'delete_symptoms_type_details'])->name('delete-symptoms-type-details');
            });
            Route::group(['middleware' => ['permission:edit symptoms type']], function () {
                Route::get('edit-symptoms-type-details/{id}', [SymptomsController::class, 'edit_symptoms_type_details'])->name('edit-symptoms-type-details');
                Route::post('update-symptoms-type-details', [SymptomsController::class, 'update_symptoms_type_details'])->name('update-symptoms-type-details');
            });
        });
        // ==================================  Symptoms Type =================

        // ================================== Symptoms Head =================
        Route::group(['middleware' => ['permission:symptoms head']], function () {

            Route::group(['middleware' => ['permission:add symptoms head']], function () {
                Route::get('symptoms-head-details', [SymptomsController::class, 'symptoms_head_details'])->name('symptoms-head-details');
                Route::post('save-symptoms-head-details', [SymptomsController::class, 'save_symptoms_head_details'])->name('save-symptoms-head-details');
            });
            Route::group(['middleware' => ['permission:delete symptoms head']], function () {
                Route::get('delete-symptoms-head-details/{id}', [SymptomsController::class, 'delete_symptoms_head_details'])->name('delete-symptoms-head-details');
            });
            Route::group(['middleware' => ['permission:edit symptoms head']], function () {
                Route::get('edit-symptoms-head-details/{id}', [SymptomsController::class, 'edit_symptoms_head_details'])->name('edit-symptoms-head-details');
                Route::post('update-symptoms-head-details', [SymptomsController::class, 'update_symptoms_head_details'])->name('update-symptoms-head-details');
            });
        });
        // ==================================  Symptoms Head =================
    });
    // ==================================  Symptoms  =================

    // ================================== Diagonasis =================
    Route::group(['middleware' => ['permission:diagonasis']], function () {

        Route::group(['middleware' => ['permission:add diagonasis']], function () {
            Route::get('diagonasis-details', [DiagonasisController::class, 'diagonasis_details'])->name('diagonasis-details');
            Route::post('save-diagonasis-details', [DiagonasisController::class, 'save_diagonasis_details'])->name('save-diagonasis-details');
        });
        Route::group(['middleware' => ['permission:delete diagonasis']], function () {
            Route::get('delete-diagonasis-details/{id}', [DiagonasisController::class, 'delete_diagonasis_details'])->name('delete-diagonasis-details');
        });
        Route::group(['middleware' => ['permission:edit diagonasis']], function () {
            Route::get('edit-diagonasis-details/{id}', [DiagonasisController::class, 'edit_diagonasis_details'])->name('edit-diagonasis-details');
            Route::post('update-diagonasis-details', [DiagonasisController::class, 'update_diagonasis_details'])->name('update-diagonasis-details');
        });
    });
    // ================================== Diagonasis =================

    // ================================== Tpa Management =================
    Route::group(['middleware' => ['permission:tpa management']], function () {

        Route::group(['middleware' => ['permission:add tpa management']], function () {
            Route::get('tpa-management-details', [TpaManagemnetController::class, 'tpa_management_details'])->name('tpa-management-details');
            Route::post('save-tpa-management-details', [TpaManagemnetController::class, 'save_tpa_management_details'])->name('save-tpa-management-details');
        });
        Route::group(['middleware' => ['permission:delete tpa management']], function () {
            Route::get('delete-tpa-management-details/{id}', [TpaManagemnetController::class, 'delete_tpa_management_details'])->name('delete-tpa-management-details');
        });
        Route::group(['middleware' => ['permission:edit tpa management']], function () {
            Route::get('edit-tpa-management-details/{id}', [TpaManagemnetController::class, 'edit_tpa_management_details'])->name('edit-tpa-management-details');
            Route::post('update-tpa-management-details', [TpaManagemnetController::class, 'update_tpa_management_details'])->name('update-tpa-management-details');
        });
    });
    // ================================== Tpa Management =================

    // ====================== Blood Bank ==================
    Route::group(['middleware' => ['permission:blood bank']], function () {

        // ==================================  Product =================
        Route::group(['middleware' => ['permission:blood bank product']], function () {

            Route::group(['middleware' => ['permission:add blood bank product']], function () {
                Route::get('blood-bank-product-details', [ProductController::class, 'product_details'])->name('blood-bank-product-details');
                Route::post('save-blood-bank-product-details', [ProductController::class, 'save_product_details'])->name('save-blood-bank-product-details');
            });
            Route::group(['middleware' => ['permission:delete blood bank product']], function () {
                Route::get('delete-blood-bank-product-details/{id}', [ProductController::class, 'delete_product_details'])->name('delete-blood-bank-product-details');
            });
            Route::group(['middleware' => ['permission:edit blood bank product']], function () {
                Route::get('edit-blood-bank-product-details/{id}', [ProductController::class, 'edit_product_details'])->name('edit-blood-bank-product-details');
                Route::post('update-blood-bank-product-details', [ProductController::class, 'update_product_details'])->name('update-blood-bank-product-details');
            });
        });
        // =============================== Product =================
    });
    // =============================== Blood Bank =================

    // ====================== Appointment ==================
    Route::group(['middleware' => ['permission:appointment']], function () {

        // ================================== shift =================
        Route::group(['middleware' => ['permission:shift']], function () {

            Route::group(['middleware' => ['permission:add shift']], function () {
                Route::get('shift-details', [ShiftController::class, 'shift_details'])->name('shift-details');
                Route::post('save-shift-details', [ShiftController::class, 'save_shift_details'])->name('save-shift-details');
            });
            Route::group(['middleware' => ['permission:delete shift']], function () {
                Route::get('delete-shift-details/{id}', [ShiftController::class, 'delete_shift_details'])->name('delete-shift-details');
            });
            Route::group(['middleware' => ['permission:edit shift']], function () {
                Route::get('edit-shift-details/{id}', [ShiftController::class, 'edit_shift_details'])->name('edit-shift-details');
                Route::post('update-shift-details', [ShiftController::class, 'update_shift_details'])->name('update-shift-details');
            });
        });
        // =============================== shift ===========================

        // ================================== slots =================
        Route::group(['middleware' => ['permission:slots']], function () {

            Route::get('slots-details', [SlotController::class, 'slots_details'])->name('slots-details');

            Route::group(['middleware' => ['permission:add slots']], function () {
                Route::get('add-slots-details', [SlotController::class, 'add_slots_details'])->name('add-slots-details');
                Route::post('save-slots-details', [SlotController::class, 'save_slots_details'])->name('save-slots-details');
            });
            Route::group(['middleware' => ['permission:delete slots']], function () {
                Route::get('delete-slots-details/{id}', [SlotController::class, 'delete_slots_details'])->name('delete-slots-details');
            });
            Route::group(['middleware' => ['permission:edit slots']], function () {
                Route::get('edit-slots-details/{id}', [SlotController::class, 'edit_slots_details'])->name('edit-slots-details');
                Route::post('update-slots-details', [SlotController::class, 'update_slots_details'])->name('update-slots-details');
            });

            Route::post('find-sub-catagory-by-catagory', [SlotController::class, 'find_sub_catagory_by_catagory'])->name('find-sub-catagory-by-catagory');
            Route::post('find-charge-by-sub-catagory', [SlotController::class, 'find_charge_by_sub_catagory'])->name('find-charge-by-sub-catagory');
            Route::post('find-charge-by-statndard-charges', [SlotController::class, 'find_charge_by_statndard_charges'])->name('find-charge-by-statndard-charges');
        });
        // =============================== slots =================
    });
    // =============================== Appointment =================


    // ====================== Pathology ==================
    Route::group(['middleware' => ['permission:pathology']], function () {

        // ================================== Pathology Catagory =================
        Route::group(['middleware' => ['permission:pathology catagory']], function () {

            Route::group(['middleware' => ['permission:add pathology catagory']], function () {
                Route::get('pathology-catagory-details', [PathologyCatagoryController::class, 'catagory_details'])->name('pathology-catagory-details');
                Route::post('save-pathology-catagorydetails', [PathologyCatagoryController::class, 'save_catagory_details'])->name('save-pathology-catagory-details');
            });
            Route::group(['middleware' => ['permission:delete pathology catagory']], function () {
                Route::get('delete-pathology-catagory-details/{id}', [PathologyCatagoryController::class, 'delete_catagory_details'])->name('delete-pathology-catagory-details');
            });
            Route::group(['middleware' => ['permission:edit pathology catagory']], function () {
                Route::get('edit-pathology-catagory-details/{id}', [PathologyCatagoryController::class, 'edit_catagory_details'])->name('edit-pathology-catagory-details');
                Route::post('update-pathology-catagory-details', [PathologyCatagoryController::class, 'update_catagory_details'])->name('update-pathology-catagory-details');
            });
        });
        // ================================== Pathology Catagory =================

        // ================================== Pathology Unit =================
        Route::group(['middleware' => ['permission:pathology unit']], function () {

            Route::group(['middleware' => ['permission:add pathology unit']], function () {
                Route::get('pathology-unit-details', [PathologyUnitController::class, 'unit_details'])->name('pathology-unit-details');
                Route::post('save-pathology-unit-details', [PathologyUnitController::class, 'save_unit_details'])->name('save-pathology-unit-details');
            });
            Route::group(['middleware' => ['permission:delete pathology unit']], function () {
                Route::get('delete-pathology-unit-details/{id}', [PathologyUnitController::class, 'delete_unit_details'])->name('delete-pathology-unit-details');
            });
            Route::group(['middleware' => ['permission:edit pathology unit']], function () {
                Route::get('edit-pathology-unit-details/{id}', [PathologyUnitController::class, 'edit_unit_details'])->name('edit-pathology-unit-details');
                Route::post('update-pathology-unit-details', [PathologyUnitController::class, 'update_unit_details'])->name('update-pathology-unit-details');
            });
        });
        // ================================== Pathology Unit =================

        // ================================== Pathology Parameter =================
        Route::group(['middleware' => ['permission:pathology parameter']], function () {

            Route::group(['middleware' => ['permission:add pathology parameter']], function () {
                Route::get('pathology-parameter-details', [PathologyParameterController::class, 'parameter_details'])->name('pathology-parameter-details');
                Route::post('save-pathology-parameter-details', [PathologyParameterController::class, 'save_parameter_details'])->name('save-pathology-parameter-details');
            });
            Route::group(['middleware' => ['permission:delete pathology parameter']], function () {
                Route::get('delete-pathology-parameter-details/{id}', [PathologyParameterController::class, 'delete_parameter_details'])->name('delete-pathology-parameter-details');
            });
            Route::group(['middleware' => ['permission:edit pathology parameter']], function () {
                Route::get('edit-pathology-parameter-details/{id}', [PathologyParameterController::class, 'edit_parameter_details'])->name('edit-pathology-parameter-details');
                Route::post('update-pathology-parameter-details', [PathologyParameterController::class, 'update_parameter_details'])->name('update-pathology-parameter-details');
            });
        });
        // ================================== Pathology Parameter =================
    });
    // ====================== Pathology ==================


    // ====================== Radiology ==================
    Route::group(['middleware' => ['permission:pathology']], function () {

        // ================================== Radiology Catagory =================
        Route::group(['middleware' => ['permission:radiology catagory']], function () {

            Route::group(['middleware' => ['permission:add radiology catagory']], function () {
                Route::get('radiology-catagory-details', [RadiologyCatagoryController::class, 'catagory_details'])->name('radiology-catagory-details');
                Route::post('save-radiology-catagorydetails', [RadiologyCatagoryController::class, 'save_catagory_details'])->name('save-radiology-catagory-details');
            });
            Route::group(['middleware' => ['permission:delete radiology catagory']], function () {
                Route::get('delete-radiology-catagory-details/{id}', [RadiologyCatagoryController::class, 'delete_catagory_details'])->name('delete-radiology-catagory-details');
            });
            Route::group(['middleware' => ['permission:edit radiology catagory']], function () {
                Route::get('edit-radiology-catagory-details/{id}', [RadiologyCatagoryController::class, 'edit_catagory_details'])->name('edit-radiology-catagory-details');
                Route::post('update-radiology-catagory-details', [RadiologyCatagoryController::class, 'update_catagory_details'])->name('update-radiology-catagory-details');
            });
        });
        // ================================== Radiology Catagory =================

        // ================================== Radiology Unit =================
        Route::group(['middleware' => ['permission:radiology unit']], function () {

            Route::group(['middleware' => ['permission:add radiology unit']], function () {
                Route::get('radiology-unit-details', [RadiologyUnitController::class, 'unit_details'])->name('radiology-unit-details');
                Route::post('save-radiology-unit-details', [RadiologyUnitController::class, 'save_unit_details'])->name('save-radiology-unit-details');
            });
            Route::group(['middleware' => ['permission:delete radiology unit']], function () {
                Route::get('delete-radiology-unit-details/{id}', [RadiologyUnitController::class, 'delete_unit_details'])->name('delete-radiology-unit-details');
            });
            Route::group(['middleware' => ['permission:edit radiology unit']], function () {
                Route::get('edit-radiology-unit-details/{id}', [RadiologyUnitController::class, 'edit_unit_details'])->name('edit-radiology-unit-details');
                Route::post('update-radiology-unit-details', [RadiologyUnitController::class, 'update_unit_details'])->name('update-radiology-unit-details');
            });
        });
        // ================================== Radiology Unit =================

        // ================================== Radiology Parameter =================
        Route::group(['middleware' => ['permission:radiology parameter']], function () {

            Route::group(['middleware' => ['permission:add radiology parameter']], function () {
                Route::get('radiology-parameter-details', [RadiologyParameterController::class, 'parameter_details'])->name('radiology-parameter-details');
                Route::post('save-radiology-parameter-details', [RadiologyParameterController::class, 'save_parameter_details'])->name('save-radiology-parameter-details');
            });
            Route::group(['middleware' => ['permission:delete radiology parameter']], function () {
                Route::get('delete-radiology-parameter-details/{id}', [RadiologyParameterController::class, 'delete_parameter_details'])->name('delete-radiology-parameter-details');
            });
            Route::group(['middleware' => ['permission:edit radiology parameter']], function () {
                Route::get('edit-radiology-parameter-details/{id}', [RadiologyParameterController::class, 'edit_parameter_details'])->name('edit-radiology-parameter-details');
                Route::post('update-radiology-parameter-details', [RadiologyParameterController::class, 'update_parameter_details'])->name('update-radiology-parameter-details');
            });
        });
        // ================================== Radiology Parameter =================
    });
    // ====================== Radiology ==================
    //====================== EMG Set Up ================================
    Route::group(['middleware' => ['permission:Emg setUp']], function () {
        Route::get('emg-set-up', [EmgController::class, 'emg_set_up'])->name('emg-set-up');
        Route::post('save-emg-set-up', [EmgController::class, 'add_emg_set_up'])->name('save-emg-setup-details');
    });
    // ---------
    Route::get('payment-listing-in-emg', [EmgController::class, 'emg_set_up'])->name('payment-listing-in-emg');


    //====================== EMG Set Up ================================

    // ====================== Setup Pharmacy ==================
    Route::group(['middleware' => ['permission:setup pharmacy ']], function () {

        // ================================== medicine store =================
        Route::group(['middleware' => ['permission:medicine store']], function () {

            Route::group(['middleware' => ['permission:add medicine store']], function () {
                Route::get('medicine-store-details', [MedcineStoreController::class, 'medicine_store_listing'])->name('medicine-store-details');
                Route::post('save-medicine-store-details', [MedcineStoreController::class, 'save_medicine_store'])->name('save-medicine-store-details');
            });
            Route::group(['middleware' => ['permission:delete medicine store']], function () {
                Route::get('delete-medicine-store-details/{id}', [MedcineStoreController::class, 'delete_medicine_store'])->name('delete-medicine-store-details');
            });
            Route::group(['middleware' => ['permission:edit medicine store']], function () {
                Route::get('edit-medicine-store-details/{id}', [MedcineStoreController::class, 'edit_medicine_store'])->name('edit-medicine-store-details');
                Route::post('update-medicine-store-details', [MedcineStoreController::class, 'update_medicine_store'])->name('update-medicine-store-details');
            });
        });
        // ================================== medicine store =================

        // ================================== medicine store room =================
        Route::group(['middleware' => ['permission:medicine storeroom']], function () {

            Route::group(['middleware' => ['permission:add medicine storeroom']], function () {
                Route::get('medicine-store-room-details', [MedicineStoreRoomController::class, 'medicine_store_room_listing'])->name('medicine-store-room-details');
                Route::post('save-medicine-store-room-details', [MedicineStoreRoomController::class, 'save_medicine_store_room'])->name('save-medicine-store-room-details');
            });
            Route::group(['middleware' => ['permission:delete medicine storeroom']], function () {
                Route::post('delete-medicine-store-room-details', [MedicineStoreRoomController::class, 'delete_medicine_store_room'])->name('delete-medicine-store-room-details');
            });
            Route::group(['middleware' => ['permission:edit medicine storeroom']], function () {
                Route::get('edit-medicine-store-room-details/{id}', [MedicineStoreRoomController::class, 'edit_medicine_store_room'])->name('edit-medicine-store-room-details');
                Route::post('update-medicine-store-room-details', [MedicineStoreRoomController::class, 'update_medicine_store_room'])->name('update-medicine-store-room-details');
            });
        });
        // ================================== medicine store room =================

        // ================================== medicine rack =================
        Route::group(['middleware' => ['permission:medicine rack']], function () {

            Route::group(['middleware' => ['permission:add medicine rack']], function () {
                Route::get('medicine-rack-details', [MedcineRackController::class, 'medicine_rack_listing'])->name('medicine-rack-details');
                Route::post('save-medicine-rack-details', [MedcineRackController::class, 'save_medicine_rack'])->name('save-medicine-rack-details');
            });
            Route::group(['middleware' => ['permission:delete medicine rack']], function () {
                Route::get('delete-medicine-rack-details/{id}', [MedcineRackController::class, 'delete_medicine_rack'])->name('delete-medicine-rack-details');
            });
            Route::group(['middleware' => ['permission:edit medicine rack']], function () {
                Route::get('edit-medicine-rack-details/{id}', [MedcineRackController::class, 'edit_medicine_rack'])->name('edit-medicine-rack-details');
                Route::post('update-medicine-rack-details', [MedcineRackController::class, 'update_medicine_rack'])->name('update-medicine-rack-details');
            });
        });
        // ================================== medicine catagory =================

        // ================================== dose duration =================
        Route::group(['middleware' => ['permission:dose duration']], function () {

            Route::group(['middleware' => ['permission:add dose duration']], function () {
                Route::get('dose-duration-details', [DoseDurationController::class, 'dose_duration_listing'])->name('dose-duration-details');
                Route::post('save-dose-duration-details', [DoseDurationController::class, 'save_dose_duration'])->name('save-dose-duration-details');
            });
            Route::group(['middleware' => ['permission:delete dose duration']], function () {
                Route::get('delete-dose-duration-details/{id}', [DoseDurationController::class, 'delete_dose_duration'])->name('delete-dose-duration-details');
            });
            Route::group(['middleware' => ['permission:edit dose duration']], function () {
                Route::get('edit-dose-duration-details/{id}', [DoseDurationController::class, 'edit_dose_duration'])->name('edit-dose-duration-details');
                Route::post('update-dose-duration-details', [DoseDurationController::class, 'update_dose_duration'])->name('update-dose-duration-details');
            });
        });
        // ================================== dose duration =================

        // ================================== dose interval =================
        Route::group(['middleware' => ['permission:dose interval']], function () {

            Route::group(['middleware' => ['permission:add dose interval']], function () {
                Route::get('dose-interval-details', [DoseIntervalController::class, 'dose_interval_listing'])->name('dose-interval-details');
                Route::post('save-dose-interval-details', [DoseIntervalController::class, 'save_dose_interval'])->name('save-dose-interval-details');
            });
            Route::group(['middleware' => ['permission:delete dose interval']], function () {
                Route::get('delete-dose-interval-details/{id}', [DoseIntervalController::class, 'delete_dose_interval'])->name('delete-dose-interval-details');
            });
            Route::group(['middleware' => ['permission:edit dose interval']], function () {
                Route::get('edit-dose-interval-details/{id}', [DoseIntervalController::class, 'edit_dose_interval'])->name('edit-dose-interval-details');
                Route::post('update-dose-interval-details', [DoseIntervalController::class, 'update_dose_interval'])->name('update-dose-interval-details');
            });
        });
        // ================================== dose interval =================

        // ================================== medicine unit =================
        Route::group(['middleware' => ['permission:medicine unit']], function () {

            Route::group(['middleware' => ['permission:add medicine unit']], function () {
                Route::get('medicine-unit-details', [MedicineUnitController::class, 'medicine_unit_listing'])->name('medicine-unit-details');
                Route::post('save-medicine-unit-details', [MedicineUnitController::class, 'save_medicine_unit'])->name('save-medicine-unit-details');
            });
            Route::group(['middleware' => ['permission:delete medicine unit']], function () {
                Route::get('delete-medicine-unit-details/{id}', [MedicineUnitController::class, 'delete_medicine_unit'])->name('delete-medicine-unit-details');
            });
            Route::group(['middleware' => ['permission:edit medicine unit']], function () {
                Route::get('edit-medicine-unit-details/{id}', [MedicineUnitController::class, 'edit_medicine_unit'])->name('edit-medicine-unit-details');
                Route::post('update-medicine-unit-details', [MedicineUnitController::class, 'update_medicine_unit'])->name('update-medicine-unit-details');
            });
        });
        // ================================== medicine unit =================

        // ================================== medicine dosage =================
        Route::group(['middleware' => ['permission:medicine dosage']], function () {

            Route::group(['middleware' => ['permission:add medicine dosage']], function () {
                Route::get('medicine-dosage-details', [MedicineDosageController::class, 'medicine_dosage_listing'])->name('medicine-dosage-details');
                Route::post('save-medicine-dosage-details', [MedicineDosageController::class, 'save_medicine_dosage'])->name('save-medicine-dosage-details');
            });
            Route::group(['middleware' => ['permission:delete medicine dosage']], function () {
                Route::get('delete-medicine-dosage-details/{id}', [MedicineDosageController::class, 'delete_medicine_dosage'])->name('delete-medicine-dosage-details');
            });
            Route::group(['middleware' => ['permission:edit medicine dosage']], function () {
                Route::get('edit-medicine-dosage-details/{id}', [MedicineDosageController::class, 'edit_medicine_dosage'])->name('edit-medicine-dosage-details');
                Route::post('update-medicine-dosage-details', [MedicineDosageController::class, 'update_medicine_dosage'])->name('update-medicine-dosage-details');
            });
        });
        // ================================== medicine dosage =================


        // ================================== medicine supplier =================
        Route::group(['middleware' => ['permission:medicine catagory']], function () {

            Route::group(['middleware' => ['permission:add medicine catagory']], function () {
                Route::get('medicine-supplier-details', [SupplierController::class, 'medicine_supplier_listing'])->name('medicine-supplier-details');
                Route::post('save-medicine-supplier-details', [SupplierController::class, 'save_medicine_supplier'])->name('save-medicine-supplier-details');
            });
            Route::group(['middleware' => ['permission:delete medicine catagory']], function () {
                Route::get('delete-medicine-supplier-details/{id}', [SupplierController::class, 'delete_medicine_supplier'])->name('delete-medicine-supplier-details');
            });
            Route::group(['middleware' => ['permission:edit medicine catagory']], function () {
                Route::get('edit-medicine-supplier-details/{id}', [SupplierController::class, 'edit_medicine_supplier'])->name('edit-medicine-supplier-details');
                Route::post('update-medicine-supplier-details', [SupplierController::class, 'update_medicine_supplier'])->name('update-medicine-supplier-details');
            });
        });
        // ================================== medicine supplier =================

        // ================================== medicine vendor =================
        Route::group(['middleware' => ['permission:medicine catagory']], function () {

            Route::group(['middleware' => ['permission:add medicine vendor']], function () {
                Route::get('medicine-vendor-details', [VendorController::class, 'medicine_vendor_listing'])->name('medicine-vendor-details');
                Route::get('add-medicine-vendor-details', [VendorController::class, 'add_medicine_vendor_listing'])->name('add-medicine-vendor-details');
                Route::post('save-medicine-vendor-details', [VendorController::class, 'save_medicine_vendor'])->name('save-medicine-vendor-details');
            });
            Route::group(['middleware' => ['permission:delete medicine vendor']], function () {
                Route::post('delete-medicine-vendor-details', [VendorController::class, 'delete_medicine_vendor'])->name('delete-medicine-vendor-details');
            });
            Route::group(['middleware' => ['permission:edit medicine vendor']], function () {
                Route::get('edit-medicine-vendor-details/{id}', [VendorController::class, 'edit_medicine_vendor'])->name('edit-medicine-vendor-details');
                Route::post('update-medicine-vendor-details', [VendorController::class, 'update_medicine_vendor'])->name('update-medicine-vendor-details');
            });

            Route::post('vendorDelete', [VendorController::class, 'vendorDelete'])->name('vendorDelete');
            Route::get('vendorStatusAction/{id}', [VendorController::class, 'vendorStatusAction'])->name('vendorStatusAction');
            Route::get('vendorActivation/{id}', [VendorController::class, 'vendorActivation'])->name('vendorActivation');
        });
        // ================================== medicine vendor =================
    });
    // ====================== Setup Pharmacy ==================

    // ====================== charges package ==================
    Route::group(['middleware' => ['permission:charges package']], function () {

        // ==================================charges package catagory =================
        Route::group(['middleware' => ['permission:package catagory']], function () {
            Route::group(['middleware' => ['permission:add package catagory']], function () {
                Route::get('charges-package-catagory-details', [ChargesPackageCatagoryController::class, 'charges_package_catagory_details'])->name('charges-package-catagory-details');
                Route::post('save-charges-package-catagory-details', [ChargesPackageCatagoryController::class, 'save_charges_package_catagory_details'])->name('save-charges-package-catagory-details');
            });
            Route::group(['middleware' => ['permission:delete package catagory']], function () {
                Route::get('delete-charges-package-catagory-details/{id}', [ChargesPackageCatagoryController::class, 'delete_charges_package_catagory_details'])->name('delete-charges-package-catagory-details');
            });
            Route::group(['middleware' => ['permission:edit package catagory']], function () {
                Route::get('edit-charges-package-catagory-details/{id}', [ChargesPackageCatagoryController::class, 'edit_charges_package_catagory_details'])->name('edit-charges-package-catagory-details');
                Route::post('update-charges-package-catagory-details', [ChargesPackageCatagoryController::class, 'update_charges_package_catagory_details'])->name('update-charges-package-catagory-details');
            });
        });
        // ==================================charges package catagory =================

        // ==================================charges package sub catagory =================
        Route::group(['middleware' => ['permission:package sub catagory']], function () {
            Route::group(['middleware' => ['permission:add package sub catagory']], function () {
                Route::get('charges-package-sub-catagory-details', [ChargesPackageSubCatagoryController::class, 'charges_package_sub_catagory_details'])->name('charges-package-sub-catagory-details');
                Route::post('save-charges-package-sub-catagory-details', [ChargesPackageSubCatagoryController::class, 'save_charges_package_sub_catagory_details'])->name('save-charges-package-sub-catagory-details');
            });
            Route::group(['middleware' => ['permission:delete package sub catagory']], function () {
                Route::get('delete-charges-package-sub-catagory-details/{id}', [ChargesPackageSubCatagoryController::class, 'delete_charges_package_sub_catagory_details'])->name('delete-charges-package-sub-catagory-details');
            });
            Route::group(['middleware' => ['permission:edit package sub catagory']], function () {
                Route::get('edit-charges-package-sub-catagory-details/{id}', [ChargesPackageSubCatagoryController::class, 'edit_charges_package_sub_catagory_details'])->name('edit-charges-package-sub-catagory-details');
                Route::post('update-charges-package-sub-catagory-details', [ChargesPackageSubCatagoryController::class, 'update_charges_package_sub_catagory_details'])->name('update-charges-package-sub-catagory-details');
            });
        });
        // ==================================charges package sub catagory =================

        // ==================================charges package name =================
        Route::group(['middleware' => ['permission:package name']], function () {
            Route::get('charges-package-name-details', [ChargesPackageNameController::class, 'charges_package_name_details'])->name('charges-package-name-details');
            Route::group(['middleware' => ['permission:add package name']], function () {
                Route::get('add-charges-package-name-details', [ChargesPackageNameController::class, 'add_charges_package_name_details'])->name('add-charges-package-name-details');
                Route::post('save-charges-package-name-details', [ChargesPackageNameController::class, 'save_charges_package_name_details'])->name('save-charges-package-name-details');
            });
            Route::group(['middleware' => ['permission:delete package name']], function () {
                Route::get('delete-charges-package-name-details/{id}', [ChargesPackageNameController::class, 'delete_charges_package_name_details'])->name('delete-charges-package-name-details');
            });
            Route::group(['middleware' => ['permission:edit package name']], function () {
                Route::get('edit-charges-package-name-details/{id}', [ChargesPackageNameController::class, 'edit_charges_package_name_details'])->name('edit-charges-package-name-details');
                Route::post('update-charges-package-name-details', [ChargesPackageNameController::class, 'update_charges_package_name_details'])->name('update-charges-package-name-details');
            });
            Route::post('find-charge-amount-by-charge-name', [ChargesPackageNameController::class, 'find_charge_amount_by_charge_name'])->name('find-charge-amount-by-charge-name');
            Route::post('find-charges-package-sub-catagory-by-charges-package-catagory', [ChargesPackageNameController::class, 'find_charger_package_sub_catagoyr_by_catagory'])->name('find-charges-package-sub-catagory-by-charges-package-catagory');
        });
        // ==================================charges package name =================
    });
    // ====================== charges package ==================


    // ====================== Inventory ==================
    Route::group(['middleware' => ['permission:Setup Inventory']], function () {

        // ================================== Inventory Item Catagory =================
        Route::group(['middleware' => ['permission:Inventory Item Catagory']], function () {

            Route::group(['middleware' => ['permission:Inventory Item Catagory Create']], function () {
                Route::get('add-inventory-item-catagory', [ItemCatagoryController::class, 'item_catagory_details'])->name('add-inventory-item-catagory');
                Route::post('save-inventory-item-catagory', [ItemCatagoryController::class, 'save_item_catagory'])->name('save-inventory-item-catagory');
            });
            Route::group(['middleware' => ['permission:Inventory Item Catagory Delete']], function () {
                Route::get('delete-inventory-item-catagory/{id}', [ItemCatagoryController::class, 'delete_item_catagory'])->name('delete-inventory-item-catagory');
            });
            Route::group(['middleware' => ['permission:Inventory Item Catagory Edit']], function () {
                Route::get('edit-inventory-item-catagory/{id}', [ItemCatagoryController::class, 'edit_item_catagory'])->name('edit-inventory-item-catagory');
                Route::post('update-inventory-item-catagory', [ItemCatagoryController::class, 'update_item_catagory'])->name('update-inventory-item-catagory');
            });
        });
        // ================================== Inventory Item Catagory =================

        // ================================== Inventory Item Brand =================
        Route::group(['middleware' => ['permission:Inventory Item Brand']], function () {

            Route::group(['middleware' => ['permission:Inventory Item Brand Create']], function () {
                Route::get('add-inventory-item-brand', [ItemBrandController::class, 'item_brand_details'])->name('add-inventory-item-brand');
                Route::post('save-inventory-item-brand', [ItemBrandController::class, 'save_item_brand'])->name('save-inventory-item-brand');
            });
            Route::group(['middleware' => ['permission:Inventory Item Brand Delete']], function () {
                Route::get('delete-inventory-item-brand/{id}', [ItemBrandController::class, 'delete_item_brand'])->name('delete-inventory-item-brand');
            });
            Route::group(['middleware' => ['permission:Inventory Item Brand Edit']], function () {
                Route::get('edit-inventory-item-brand/{id}', [ItemBrandController::class, 'edit_item_brand'])->name('edit-inventory-item-brand');
                Route::post('update-inventory-item-brand', [ItemBrandController::class, 'update_item_brand'])->name('update-inventory-item-brand');
            });
        });
        // ================================== Inventory Item Brand =================

        // ================================== Inventory Manufacture =================
        Route::group(['middleware' => ['permission:Inventory Item Manufacture']], function () {

            Route::group(['middleware' => ['permission:Inventory Item Manufacture Create']], function () {
                Route::get('add-inventory-manufacture', [ManufactureController::class, 'item_manufacture_details'])->name('add-inventory-manufacture');
                Route::post('save-inventory-manufacture', [ManufactureController::class, 'save_item_manufacture'])->name('save-inventory-manufacture');
            });
            Route::group(['middleware' => ['permission:Inventory Item Manufacture Delete']], function () {
                Route::get('delete-inventory-manufacture/{id}', [ManufactureController::class, 'delete_item_manufacture'])->name('delete-inventory-manufacture');
            });
            Route::group(['middleware' => ['permission:Inventory Item Manufacture Edit']], function () {
                Route::get('edit-inventory-manufacture/{id}', [ManufactureController::class, 'edit_item_manufacture'])->name('edit-inventory-manufacture');
                Route::post('update-inventory-manufacture', [ManufactureController::class, 'update_item_manufacture'])->name('update-inventory-manufacture');
            });
        });
        // ================================== Inventory Manufacture =================

        // ================================== Inventory Item Type =================
        Route::group(['middleware' => ['permission:Inventory Item Type']], function () {

            Route::group(['middleware' => ['permission:Inventory Item Type Create']], function () {
                Route::get('add-inventory-item-type', [ItemTypeController::class, 'item_item_type_details'])->name('add-inventory-item-type');
                Route::post('save-inventory-item-type', [ItemTypeController::class, 'save_item_item_type'])->name('save-inventory-item-type');
            });
            Route::group(['middleware' => ['permission:Inventory Item Type Delete']], function () {
                Route::get('delete-inventory-item-type/{id}', [ItemTypeController::class, 'delete_item_item_type'])->name('delete-inventory-item-type');
            });
            Route::group(['middleware' => ['permission:Inventory Item Type Edit']], function () {
                Route::get('edit-inventory-item-type/{id}', [ItemTypeController::class, 'edit_item_item_type'])->name('edit-inventory-item-type');
                Route::post('update-inventory-item-type', [ItemTypeController::class, 'update_item_item_type'])->name('update-inventory-item-type');
            });
        });
        // ================================== Inventory Item Type =================

        // ================================== Inventory Store Room  =================
        Route::group(['middleware' => ['permission:Inventory Store Room']], function () {

            Route::group(['middleware' => ['permission:Inventory Store Room Create']], function () {
                Route::get('add-inventory-item-store-room', [ItemStoreRoomController::class, 'item_item_store_room_details'])->name('add-inventory-item-store-room');
                Route::post('save-inventory-item-store-room', [ItemStoreRoomController::class, 'save_item_item_store_room'])->name('save-inventory-item-store-room');
            });
            Route::group(['middleware' => ['permission:Inventory Store Room Delete']], function () {
                Route::get('delete-inventory-item-store-room/{id}', [ItemStoreRoomController::class, 'delete_item_item_store_room'])->name('delete-inventory-item-store-room');
            });
            Route::group(['middleware' => ['permission:Inventory Store Room Edit']], function () {
                Route::get('edit-inventory-item-store-room/{id}', [ItemStoreRoomController::class, 'edit_item_item_store_room'])->name('edit-inventory-item-store-room');
                Route::post('update-inventory-item-store-room', [ItemStoreRoomController::class, 'update_item_item_store_room'])->name('update-inventory-item-store-room');
            });
        });
        // ================================== Inventory Store Room =================

        // ============================ Item =======================
        Route::group(['middleware' => ['permission:Inventory Item']], function () {
            Route::group(['middleware' => ['permission:Inventory Item View']], function () {
                Route::get('inventory-item-list', [ItemController::class, 'item_list'])->name('inventory-item-list');
            });
            Route::group(['middleware' => ['permission:Inventory Item Create']], function () {
                Route::get('add-Inventory-item', [ItemController::class, 'add_item_list'])->name('add-Inventory-item');
                Route::post('save-Inventory-item', [ItemController::class, 'save_item_list'])->name('save-Inventory-item');
            });
            Route::group(['middleware' => ['permission:Inventory Item Edit']], function () {
                Route::get('edit-Inventory-item/{id}', [ItemController::class, 'edit_item_list'])->name('edit-Inventory-item');
                Route::post('update-Inventory-item', [ItemController::class, 'update_item_list'])->name('update-Inventory-item');
            });
            Route::group(['middleware' => ['permission:Inventory Item Delete']], function () {
                Route::get('delete-Inventory-item/{id}', [ItemController::class, 'delete_item_list'])->name('delete-Inventory-item');
            });
        });
        // ============================ Item =======================

        // ============================ Item Attribute =======================
        Route::group(['middleware' => ['permission:Inventory Item Attribute']], function () {
            Route::group(['middleware' => ['permission:Inventory Item Attribute View']], function () {
                Route::get('inventory-item-attribute', [ItemAttributeController::class, 'item_attribute_listing'])->name('inventory-item-attribute');
            });
            Route::group(['middleware' => ['permission:Inventory Item Attribute Create']], function () {
                Route::get('add-Inventory-item-attribute', [ItemAttributeController::class, 'add_item_attribute'])->name('add-Inventory-item-attribute');
                Route::post('save-Inventory-item-attribute', [ItemAttributeController::class, 'save_item_attribute'])->name('save-Inventory-item-attribute');
            });
            Route::group(['middleware' => ['permission:Inventory Item Attribute Edit']], function () {
                Route::get('edit-Inventory-item-attribute/{id}', [ItemAttributeController::class, 'edit_item_attribute'])->name('edit-Inventory-item-attribute');
                Route::post('update-Inventory-item-attribute', [ItemAttributeController::class, 'update_item_attribute'])->name('update-Inventory-item-attribute');
            });
            Route::group(['middleware' => ['permission:Inventory Item Attribute Delete']], function () {
                Route::get('delete-Inventory-item-attribute/{id}', [ItemAttributeController::class, 'delete_item_attribute'])->name('delete-Inventory-item-attribute');
            });
        });
        // ============================ Item Attribute =======================

        // ================================== Inventory Unit  =================
        Route::group(['middleware' => ['permission:Inventory Item Unit']], function () {

            Route::group(['middleware' => ['permission:Inventory Item Uint']], function () {
                Route::get('add-inventory-item-unit', [ItemUnitController::class, 'item_unit_details'])->name('add-inventory-item-unit');
                Route::post('save-inventory-item-unit', [ItemUnitController::class, 'save_item_unit'])->name('save-inventory-item-unit');
            });
            Route::group(['middleware' => ['permission:Inventory Item Uint Delete']], function () {
                Route::post('delete-inventory-item-unit', [ItemUnitController::class, 'delete_item_unit'])->name('delete-inventory-item-unit');
            });
            Route::group(['middleware' => ['permission:Inventory Item Uint Edit']], function () {
                Route::get('edit-inventory-item-unit/{id}', [ItemUnitController::class, 'edit_item_unit'])->name('edit-inventory-item-unit');
                Route::post('update-inventory-item-unit', [ItemUnitController::class, 'update_item_unit'])->name('update-inventory-item-unit');
            });
        });
        // ================================== Inventory Unit =================

        // ============================ Vendor =======================
        Route::group(['middleware' => ['permission:Inventory Vendor']], function () {
            Route::group(['middleware' => ['permission:View Inventory Vendor']], function () {
                Route::get('inventory-vendor', [InventoryVendorController::class, 'inventory_vendor_listing'])->name('inventory-vendor');
            });
            Route::group(['middleware' => ['permission:Add Inventory Vendor']], function () {
                Route::get('add-inventory-vendor', [InventoryVendorController::class, 'add_inventory_vendor'])->name('add-inventory-vendor');
                Route::post('save-Inventory-vendor', [InventoryVendorController::class, 'save_inventory_vendor'])->name('save-Inventory-vendor');
            });
            Route::group(['middleware' => ['permission:Edit Inventory Vendor']], function () {
                Route::get('edit-Inventory-vendor/{id}', [InventoryVendorController::class, 'edit_inventory_vendor'])->name('edit-Inventory-vendor');
                Route::post('update-Inventory-vendor', [InventoryVendorController::class, 'update_inventory_vendor'])->name('update-Inventory-vendor');
            });
            Route::group(['middleware' => ['permission:Delete Inventory Vendor']], function () {
                Route::post('delete-Inventory-vendor', [InventoryVendorController::class, 'delete_inventory_vendor'])->name('delete-Inventory-vendor');
            });

            Route::get('vendorStatusActionInventory/{id}', [InventoryVendorController::class, 'vendorStatusActionInventory'])->name('vendorStatusActionInventory');
            Route::get('vendorActivationInventory/{id}', [InventoryVendorController::class, 'vendorActivationInventory'])->name('vendorActivationInventory');
        });
        // ============================ Vendor =======================
    });

    // ====================== Inventory ==================


    // ====================== Front Office ==================
    Route::group(['middleware' => ['permission:front office']], function () {

        // ================================== Purpose =================
        Route::group(['middleware' => ['permission:purpose']], function () {

            Route::group(['middleware' => ['permission:Add purpose']], function () {
                Route::get('add-purpose-in-front-office', [PurposeController::class, 'add_purpose_details'])->name('add-purpose-in-front-office');
                Route::post('save-purpose-in-front-office', [PurposeController::class, 'save_purpose_front_office'])->name('save-purpose-in-front-office');
            });
            Route::group(['middleware' => ['permission:Delete purpose']], function () {
                Route::get('delete-purpose-in-front-office/{id}', [PurposeController::class, 'delete_purpose_in_front_office'])->name('delete-purpose-in-front-office');
            });
            Route::group(['middleware' => ['permission:Edit purpose']], function () {
                Route::get('edit-purpose-in-front-office/{id}', [PurposeController::class, 'edit_purpose_in_front_office'])->name('edit-purpose-in-front-office');
                Route::post('update-purpose-in-front-office', [PurposeController::class, 'update_purpose_front_office'])->name('update-purpose-in-front-office');
            });
        });

        // ================================== Purpose =================

        // ================================== Complain Type =================
        Route::group(['middleware' => ['permission:complain type']], function () {

            Route::group(['middleware' => ['permission:Add complain-type']], function () {
                Route::get('add-complain-type-in-front-office', [ComplainTypeController::class, 'add_complain_type_details'])->name('add-complain-type-in-front-office');
                Route::post('save-complain-type-in-front-office', [ComplainTypeController::class, 'save_complain_type_front_office'])->name('save-complain-type-in-front-office');
            });
            Route::group(['middleware' => ['permission:Delete complain type']], function () {
                Route::get('delete-complain-type-in-front-office/{id}', [ComplainTypeController::class, 'delete_complain_type_in_front_office'])->name('delete-complain-type-in-front-office');
            });
            Route::group(['middleware' => ['permission:Edit complain type']], function () {
                Route::get('edit-complain-type-in-front-office/{id}', [ComplainTypeController::class, 'edit_complain_type_in_front_office'])->name('edit-complain-type-in-front-office');
                Route::post('update-complain-type-in-front-office', [ComplainTypeController::class, 'update_complain_type_front_office'])->name('update-complain-type-in-front-office');
            });
        });

        // ================================== Complain Type =================

        // ================================== source =================
        Route::group(['middleware' => ['permission:source']], function () {

            Route::group(['middleware' => ['permission:Add source']], function () {
                Route::get('add-source-in-front-office', [SourceController::class, 'add_source_details'])->name('add-source-in-front-office');
                Route::post('save-source-in-front-office', [SourceController::class, 'save_source_front_office'])->name('save-source-in-front-office');
            });
            Route::group(['middleware' => ['permission:Delete source']], function () {
                Route::get('delete-source-in-front-office/{id}', [SourceController::class, 'delete_source_in_front_office'])->name('delete-source-in-front-office');
            });
            Route::group(['middleware' => ['permission:Edit source']], function () {
                Route::get('edit-source-in-front-office/{id}', [SourceController::class, 'edit_source_in_front_office'])->name('edit-source-in-front-office');
                Route::post('update-source-in-front-office', [SourceController::class, 'update_source_front_office'])->name('update-source-in-front-office');
            });
        });

        // ================================== source =================

        // ================================== appointment priority =================
        Route::group(['middleware' => ['permission:appointment priority']], function () {

            Route::group(['middleware' => ['permission:Add appointment priority']], function () {
                Route::get('add-appointment-priority-in-front-office', [SourceController::class, 'add_appointment_priority_details'])->name('add-appointment-priority-in-front-office');
                Route::post('save-appointment-priority-in-front-office', [SourceController::class, 'save_appointment_priority_front_office'])->name('save-appointment-priority-in-front-office');
            });
            Route::group(['middleware' => ['permission:Delete appointment priority']], function () {
                Route::get('delete-appointment-priority-in-front-office/{id}', [SourceController::class, 'delete_appointment_priority_in_front_office'])->name('delete-appointment-priority-in-front-office');
            });
            Route::group(['middleware' => ['permission:Edit appointment priority']], function () {
                Route::get('edit-appointment-priority-in-front-office/{id}', [SourceController::class, 'edit_appointment_priority_in_front_office'])->name('edit-appointment-priority-in-front-office');
                Route::post('update-appointment-priority-in-front-office', [SourceController::class, 'update_appointment_priority_front_office'])->name('update-appointment-priority-in-front-office');
            });
        });

        // ================================== appointment priority =================

    });
    // ====================== Front Office ==================


});

// ======================================== Set Up =========================================

// ================================bed status==============================================
Route::group(['middleware' => ['permission:Bed Status']], function () {
    Route::get('bed-status', [BedController::class, 'bed_status'])->name('bed_status');
    Route::post('find-bed-by-ward-in-bed-status', [BedController::class, 'find_bed_by_ward_in_bed_status'])->name('find-bed-by-ward-in-bed-status');
});
// ================================bed status==============================================

// ================================ referral ==============================================
Route::group(['middleware' => ['permission:Bed Status']], function () {
    Route::get('referral', [ReferralController::class, 'index'])->name('referral');
    Route::get('add-referral', [ReferralController::class, 'add_referral'])->name('add-referral');
    Route::post('save-referral', [ReferralController::class, 'save_referral'])->name('save-referral');
});
// ================================ referral ==============================================


// ================================== Pharmacy Main =================
Route::group(['middleware' => ['permission:pharmacy main'], 'prefix' => 'pharmacy'], function () {
    Route::group(['middleware' => ['permission:pharmacy bill']], function () {
        Route::get('pharmacy-bill-listing', [PharmacyController::class, 'pharmacy_bill_listing'])->name('pharmacy-bill-listing');
        Route::group(['middleware' => ['permission:add pharmacy bill']], function () {
            Route::get('generate-medicine-bill', [PharmacyController::class, 'pharmacy_bill_add'])->name('generate-medicine-bill');
            Route::post('add-pharmacy-billing-for-a-patient', [PharmacyController::class, 'add_pharmacy_billing_for_a_patient'])->name('add-pharmacy-billing-for-a-patient');
            Route::post('find-medicine-name-by-category', [PharmacyController::class, 'medicine_name_by_medicine_category'])->name('find-medicine-name-by-category');
            Route::post('find-medicine-batch-by-medicine-name', [PharmacyController::class, 'find_medicine_batch_by_medicine_name'])->name('find-medicine-batch-by-medicine-name');
            Route::post('find-medicine-details-by-medicine-batch', [PharmacyController::class, 'find_medicine_details_by_medicine_batch'])->name('find-medicine-details-by-medicine-batch');
            Route::post('save-pharmacy-billing', [PharmacyController::class, 'save_pharmacy_billing'])->name('save-pharmacy-billing');
        });
    });
    Route::group(['middleware' => ['permission:medicine stock']], function () {
        Route::get('all-medicine-stock', [PharmacyController::class, 'all_medicine_stock'])->name('all-medicine-stock');
    });

    //================================= medicine ===================================================
    Route::group(['middleware' => ['permission:medicine']], function () {
        Route::get('all-medicine-listing', [MedicineController::class, 'medicine_details'])->name('all-medicine-listing');

        Route::group(['middleware' => ['permission:add medicine']], function () {
            Route::get('add-medicine-details', [MedicineController::class, 'add_medicine_details'])->name('add-medicine-details');
            Route::post('save-medicine-details', [MedicineController::class, 'save_medicine_details'])->name('save-medicine-details');
        });
        Route::group(['middleware' => ['permission:edit medicine']], function () {
            Route::get('edit-medicine-details/{id}', [MedicineController::class, 'edit_medicine_details'])->name('edit-medicine-details');
            Route::post('update-medicine-details', [MedicineController::class, 'update_medicine_details'])->name('update-medicine-details');
        });
        Route::group(['middleware' => ['permission:delete medicine']], function () {
            Route::get('delete-medicine-details/{id}', [MedicineController::class, 'delete_medicine_details'])->name('delete-medicine-details');
        });

        //==============================medicine-import====================================
        Route::group(['middleware' => ['permission:medicine import']], function () {
            Route::get('import-medicine', [MedicineController::class, 'import_medicine'])->name('import-medicine');
            Route::post('upload-import-medicine', [
                MedicineController::class, 'upload_import_medicine'
            ])->name('upload-import-medicine');
        });
        //===============================medicine-import===================================

        // ================================== medicine purchase  ==============================
        Route::group(['middleware' => ['permission:medicine purchase']], function () {

            // ================================== medicine requisition  ==============================
            Route::group(['middleware' => ['permission:medicine requisition']], function () {

                Route::get('all-medicine-requisition-listing', [MedicineRequisitionController::class, 'medicine_requisition_details'])->name('all-medicine-requisition-listing');

                Route::post('add-medicine-catagory-and-medicine-name', [MedicineRequisitionController::class, 'allmedicine'])->name('add-medicine-catagory-and-medicine-name');

                Route::group(['middleware' => ['permission:add medicine requisition']], function () {
                    Route::get('add-medicine-requisition-details', [MedicineRequisitionController::class, 'add_medicine_requisition_details'])->name('add-medicine-requisition-details');
                    Route::post('save-medicine-requisition-details', [MedicineRequisitionController::class, 'save_medicine_requisition_details'])->name('save-medicine-requisition-details');
                });
                Route::group(['middleware' => ['permission:edit medicine requisition']], function () {
                    Route::get('edit-medicine-requisition-details/{id}', [MedicineRequisitionController::class, 'edit_medicine_requisition_details'])->name('edit-medicine-requisition-details');
                    Route::post('update-medicine-requisition-details', [MedicineRequisitionController::class, 'update_medicine_requisition_details'])->name('update-medicine-requisition-details');
                });
                Route::group(['middleware' => ['permission:delete medicine requisition']], function () {
                    Route::get('delete-medicine-requisition-details/{id}', [MedicineRequisitionController::class, 'delete_medicine_requisition_details'])->name('delete-medicine-requisition-details');
                });
                Route::post('/given-approval', [MedicineRequisitionController::class, 'given_approval'])->name('given-approval');
                Route::get('/requisition-details/{id?}', [MedicineRequisitionController::class, 'all_medicine_requisition_details'])->name('medicine-requisition-details');

                Route::post('find-medicine-name-by-medicine-catagory-in-requisition', [MedicineRequisitionController::class, 'find_medicine_name_by_catagory_id'])->name('find-medicine-name-by-medicine-catagory-in-requisition');
                Route::post('find-medicine-unit-by-medicine-name-in-requisition', [MedicineRequisitionController::class, 'find_medicine_name_by_medicine_name'])->name('find-medicine-unit-by-medicine-name-in-requisition');

                Route::post('/vendor-select-for-po', [MedicineRequisitionController::class, 'vendor_select_for_po'])->name('vendor-select-for-po');
                Route::post('/vendor-quatation', [MedicineRequisitionController::class, 'vendor_quatation'])->name('add-vendor-quatation');
                //vendor quatation
                Route::post('/give-approval-vendor', [MedicineRequisitionController::class, 'give_approval_vendor'])->name('give-approval-vendor');
                Route::post('add-vender-for-quatation', [MedicineRequisitionController::class, 'add_vender_for_quatation'])->name('add-vender-for-quatation');
                Route::post('/add-vendor-permission', [MedicineRequisitionController::class, 'add_vendor_permission'])->name('add-vendor-permission');

                Route::group(['middleware' => ['permission:print requisition']], function () {
                    Route::get('/print-req/{id?}', [MedicineRequisitionController::class, '_printRequisition'])->name('print-requisition');
                });
            });
            // ================================== medicine requisition  ==============================

            // ================================== medicine Purchase Order ==============================
            Route::group(['middleware' => ['permission:medicine purchase order']], function () {

                Route::get('all-medicine-purchase-order-listing', [PurchaseOrderController::class, 'medicine_purchase_order_details'])->name('all-medicine-purchase-order-listing');
                Route::group(['middleware' => ['permission:add medicine purchase order']], function () {
                    Route::get('add-medicine-purchase-order', [PurchaseOrderController::class, 'add_medicine_purchase_order_details'])->name('add-medicine-purchase-order');
                    Route::post('save-medicine-purchase-order', [PurchaseOrderController::class, 'save_medicine_purchase_order_details'])->name('save-medicine-purchase-order');

                    Route::get('/get-requisition-item-details/{requisition_id?}', [PurchaseOrderController::class, 'get_requisition_item_details'])->name('get-requisition-item-details');
                });
                Route::group(['middleware' => ['permission:save feedback']], function () {
                    Route::post('feedback-save', [PurchaseOrderController::class, 'save_feedback'])->name('feedback-save');
                });
                Route::group(['middleware' => ['permission:permission on po section']], function () {
                    Route::post('po-status-change', [PurchaseOrderController::class, 'po_status_change'])->name('po-status-change');
                });
                Route::group(['middleware' => ['permission:New Vendor Add in PO section']], function () {
                    Route::post('/vendor-select-change', [PurchaseOrderController::class, 'vendor_select_change'])->name('vendor-select-change-afetr-po');
                });
                Route::group(['middleware' => ['permission:Print Purchase Order']], function () {
                    Route::get('po-print/{po_id?}', [PurchaseOrderController::class, 'print_po'])->name('po-print');
                });
                Route::group(['middleware' => ['permission:Send PO with feedback form']], function () {
                    Route::get('send-po-feedback/{po_id?}/{vendor_id?}', [PurchaseOrderController::class, 'send_po_feedback'])->name('send-po-feedback');
                });

                Route::group(['middleware' => ['permission:edit medicine purchase order']], function () {
                    Route::get('po-edit/{po_id?}', [PurchaseOrderController::class, 'edit_po'])->name('po-edit');
                    Route::post('/po-update', [PurchaseOrderController::class, 'po_update'])->name('po-update');
                });

                Route::post('expected-delivery-date', [PurchaseOrderController::class, 'save_expected_delivery_date'])->name('expected-delivery-date');
                Route::get('/get-requisition-details/{vendor_id?}/{storeroom?}', [PurchaseOrderController::class, 'get_requisition_details'])->name('get-requisition-details');
                Route::get('/purchase-order-details/{id?}', [PurchaseOrderController::class, 'purchase_order_details'])->name('purchase-order-details');
            });

            // ================================== medicine Purchase Order ==============================

            // ================================== medicine grn ==============================
            Route::group(['middleware' => ['permission:Medicine GRN']], function () {

                Route::get('medicine-grn-list', [GRNController::class, 'index'])->name('medicine-grn-list');
                Route::group(['middleware' => ['permission:Medicine GRN Create']], function () {
                    Route::get('medicine-grn-create', [GRNController::class, 'create_grn'])->name('medicine-grn-create');
                    Route::get('/get-po-item-details/{id?}', [GRNController::class, 'get_po_item_details'])->name('get-po-item-details');
                    Route::post('save-grn', [GRNController::class, 'save_grn'])->name('save-grn');
                });

                Route::get('medicine-grn-details/{id?}', [GRNController::class, 'grn_details'])->name('medicine-grn-details');

                Route::group(['middleware' => ['permission:GRN delete']], function () {
                    Route::get('grm-delete/{id?}', [GRNController::class, 'grn_delete'])->name('grn-delete');
                });
                Route::group(['middleware' => ['permission:GRN edit']], function () {
                    Route::get('/grn-edit/{id?}', [GRNController::class, 'grn_edit'])->name('grn-edit');
                    Route::post('/grn-update', [GRNController::class, 'update_grn'])->name('update_grn');
                });
                Route::group(['middleware' => ['permission:GRN edit']], function () {
                    Route::get('/stock-update-after-grn/{id?}', [GRNController::class, 'stock_update_after_grn'])->name('stock-update-after-grn');
                });
            });


            // ================================== medicine grn ==============================
        });
        // ================================== medicine purchase =============================


    });
    //================================= medicine ===================================================

});
// ================================== Pharmacy Main =================

// ================================== Inventory  ==============================
Route::group(['middleware' => ['permission:Inventory']], function () {

    Route::get('item-stock-listing', [ItemStockController::class, 'item_stock_details'])->name('item-stock-listing');

    // ================================== Inventory requisition  ==============================
    Route::group(['middleware' => ['permission:View Inventory Reqiuisition']], function () {

        Route::get('all-inventory-requisition-listing', [ItemRequisitionController::class, 'inventory_requisition_listing'])->name('all-inventory-requisition-listing');

        Route::group(['middleware' => ['permission:Add Inventory Reqiuisition']], function () {

            Route::get('add-inventory-requisition-details', [ItemRequisitionController::class, 'add_inventory_requisition_details'])->name('add-inventory-requisition-details');
            Route::post('save-inventory-requisition-details', [ItemRequisitionController::class, 'save_inventory_requisition_details'])->name('save-inventory-requisition-details');
            Route::post('/get-item-details', [ItemRequisitionController::class, 'get_item_details'])->name('get-item-details');
            Route::post('/get-item-ajax', [ItemRequisitionController::class, 'get_item_ajax'])->name('get-item');
            Route::post('/get-item-brand-all', [ItemRequisitionController::class, 'get_item_brand_all'])->name('get-item-brand-all');
        });

        Route::group(['middleware' => ['permission:Add Inventory Reqiuisition']], function () {
            Route::get('all-inventory-requisition-details/{id}', [ItemRequisitionController::class, 'all_inventory_requisition_details'])->name('all-inventory-requisition-details');
        });

        Route::post('/add-inventory-vender-for-quatation', [ItemRequisitionController::class, 'add_inventory_vender_for_quatation'])->name('add-inventory-vender-for-quatation');
        Route::post('/add-inventory-vendor-permission', [ItemRequisitionController::class, 'add_inventory_vendor_permission'])->name('add-inventory-vendor-permission');
        Route::post('/given-approval-inventory', [ItemRequisitionController::class, 'given_approval_inventory'])->name('given-approval-inventory');
        Route::post('/give-approval-vendor-in-inventory', [ItemRequisitionController::class, 'give_approval_vendor_in_inventory'])->name('give-approval-vendor-in-inventory');
        Route::post('/vendor-quatation-inventory', [ItemRequisitionController::class, 'vendor_quatation_in_inventory'])->name('add-vendor-quatation-in-inventory');
        Route::post('/vendor-select-for-po-in-inventory', [ItemRequisitionController::class, 'vendor_select_for_po_in_inventory'])->name('vendor-select-for-po-in-inventory');
    });
    // ================================== Inventory requisition  ==============================
});
// ================================== Inventory  ==============================

// ================================== Blood Bank =================
Route::group(['middleware' => ['permission:Blood Bank'], 'prefix' => 'blood-bank'], function () {

    Route::group(['middleware' => ['permission:blood']], function () {

        Route::group(['middleware' => ['permission:View blood details']], function () {
            Route::get('all-blood-details', [BloodBankController::class, 'all_blood_details'])->name('all-blood-details');
            Route::get('blood-details/{id?}', [BloodBankController::class, 'blood_details'])->name('blood-details');

            Route::get('add-blood-issue-details/{blood_group_id?}/{id?}', [BloodBankController::class, 'add_blood_issue_details'])->name('add-blood-issue-details');
            Route::post('save-blood-issue-details', [BloodBankController::class, 'save_blood_issue_details'])->name('save-blood-issue-details');
            Route::post('add-blood-issue-belling-for-a-patient/{blood_group_id?}/{id?}', [BloodBankController::class, 'add_blood_issue_belling_for_a_patient'])->name('add-blood-issue-belling-for-a-patient');
        });

        Route::group(['middleware' => ['permission:Add blood']], function () {
            Route::get('add-blood/{id}', [BloodBankController::class, 'add_blood'])->name('add-blood');
            Route::post('save-blood', [BloodBankController::class, 'save_blood'])->name('save-blood');
            Route::post('find-charge-name-by-charge-catagory-in-blood', [BloodBankController::class, 'find_charge_name_by_catagory'])->name('find-charge-name-by-charge-catagory-in-blood');
            Route::post('find-charge-by-statndard-charges-in-blood-bank', [BloodBankController::class, 'find_standard_charges_by_charge'])->name('find-charge-by-statndard-charges-in-blood-bank');
        });
    });
    //=================== Components ======================
    Route::group(['middleware' => ['permission:blood components']], function () {

        Route::group(['middleware' => ['permission:View blood details']], function () {
            Route::get('add-blood-components-details/{id?}', [ComponentsController::class, 'add_blood_components_details'])->name('add-blood-components-details');
            Route::post('save-blood-components-details', [ComponentsController::class, 'save_blood_components_details'])->name('save-blood-components-details');
        });
    });
    //=================== Components ======================

    // ================================== unit type in blood bank  =================
    Route::group(['middleware' => ['permission:Blood unit type']], function () {

        Route::group(['middleware' => ['permission:Add blood unit type']], function () {
            Route::get('add-blood-unit-type', [UnitTypeController::class, 'add_blood_unit_type'])->name('add-blood-unit-type');
            Route::post('save-blood-unit-type', [UnitTypeController::class, 'save_blood_unit_type'])->name('save-blood-unit-type');
        });

        Route::group(['middleware' => ['permission:Edit blood unit type']], function () {
            Route::get('edit-blood-unit-type/{id}', [UnitTypeController::class, 'edit_blood_unit_type'])->name('edit-blood-unit-type');
            Route::post('update-blood-unit-type', [UnitTypeController::class, 'update_blood_unit_type'])->name('update-blood-unit-type');
        });

        Route::group(['middleware' => ['permission:Delete blood unit type']], function () {
            Route::get('delete-blood-unit-type/{id}', [UnitTypeController::class, 'delete_blood_unit_type'])->name('delete-blood-unit-type');
        });
    });
    // ================================== unit type in blood bank =================

    // ================================== Blood Donor =================
    Route::group(['middleware' => ['permission:Blood Donor']], function () {

        Route::group(['middleware' => ['permission:View Blood Donar']], function () {
            Route::get('all-blood-donor-details-listing', [BloodDonorController::class, 'all_blood_donor_details'])->name('all-blood-donor-details-listing');
        });

        Route::group(['middleware' => ['permission:Add Blood Donar']], function () {
            Route::get('add-blood-donor', [BloodDonorController::class, 'add_blood_donor'])->name('add-blood-donor');
            Route::post('save-blood-donor', [BloodDonorController::class, 'save_blood_donor'])->name('save-blood-donor');
        });

        Route::group(['middleware' => ['permission:Edit Blood Donar']], function () {
            Route::get('edit-blood-donor/{id}', [BloodDonorController::class, 'edit_blood_donor'])->name('edit-blood-donor');
            Route::post('update-blood-donor', [BloodDonorController::class, 'update_blood_donor'])->name('update-blood-donor');
        });

        Route::group(['middleware' => ['permission:Delete Blood Donar']], function () {
            Route::get('delete-blood-donor/{id}', [BloodDonorController::class, 'delete_blood_donor'])->name('delete-blood-donor');
        });
    });
    // ================================== Blood Donor =================

});
// ================================== Blood Bank =================

// ================================== Pathology Main =================
Route::group(['middleware' => ['permission:pathology main'], 'prefix' => 'pathology'], function () {
    Route::group(['middleware' => ['permission:pathology billing list']], function () {
        Route::get('pathology-billing-list', [PathologyController::class, 'pathology_billing_list'])->name('pathology-details');
    });
    Route::group(['middleware' => ['permission:add pathology bill']], function () {
        Route::get('add-pathology-billing', [PathologyController::class, 'add_pathology_bill'])->name('add-pathology-billing');
        Route::post('add-pathology-billing-for-a-patient', [PathologyController::class, 'add_pathology_billing_for_a_patient'])->name('add-pathology-billing-for-a-patient');
        Route::post('find-test-amount-by-test', [PathologyController::class, 'find_test_amount_by_test'])->name('find-test-amount-by-test');
        Route::post('save-pathology-billing', [PathologyController::class, 'save_pathology_billing'])->name('save-pathology-billing');
    });
    //pathology test
    Route::group(['middleware' => ['permission:pathology test']], function () {
        // ============= pathology master ====================
        Route::group(['middleware' => ['permission:pathology test master']], function () {
            Route::get('pathology-test-master-details', [PathologyController::class, 'pathology_test_master_details'])->name('pathology-test-master-details');
        });
        Route::group(['middleware' => ['permission:add pathology test master']], function () {
            Route::get('add-pathology-test-master-details', [PathologyController::class, 'add_pathology_test_master_details'])->name('add-pathology-test-master-details');
            Route::post('save-pathology-test-master-details', [PathologyController::class, 'save_pathology_test_master_details'])->name('save-pathology-test-master-details');
        });

        // ============= pathology master ====================
        // ============= pathology test ====================
        Route::group(['middleware' => ['permission:pathology test']], function () {
            Route::get('pathology-test-list', [PathologyController::class, 'pathology_test_list'])->name('pathology-test-list');
            Route::group(['middleware' => ['permission:add pathology test']], function () {
                Route::get('add-pathology-test', [PathologyController::class, 'add_pathology_test'])->name('add-pathology-test');
                Route::post('save-pathology-test', [PathologyController::class, 'save_pathology_test'])->name('save-pathology-test');
            });
        });
        // ============= pathology test ====================


        Route::get('pathology-test-details', [PathologyController::class, 'pathology_test_details'])->name('pathology-test-details');

        Route::get('view-pathology-test-details/{id}', [PathologyController::class, 'view_pathology_test_details'])->name('view-pathology-test-details');

        Route::group(['middleware' => ['permission:pathology test package']], function () {
            Route::get('pathology-test-package', [PathologyController::class, 'pathology_test_package_list'])->name('pathology-test-package');
            Route::group(['middleware' => ['permission:add pathology group test']], function () {
                Route::get('add-pathology-group-test', [PathologyController::class, 'add_pathology_group_test'])->name('add-pathology-group-test');
                Route::post('save-pathology-test-group', [PathologyController::class, 'save_pathology_test_group'])->name('save-pathology-test-group');
            });
        });
    });
    //pathology test

    Route::post('find-range-by-parameter', [PathologyController::class, 'find_range_by_parameter'])->name('find-range-by-parameter');
    Route::post('find-unit-by-parameter', [PathologyController::class, 'find_unit_by_parameter'])->name('find-unit-by-parameter');


    Route::group(['middleware' => ['permission:delete pathology test']], function () {
        Route::get('delete-pathology-test-details/{id}', [PathologyController::class, 'delete_pathology_test_details'])->name('delete-pathology-test-details');
    });
    Route::group(['middleware' => ['permission:edit pathology test']], function () {
        Route::get('edit-pathology-test-details/{id}', [PathologyController::class, 'edit_pathology_test_details'])->name('edit-pathology-test-details');
        Route::post('update-pathology-test-details', [PathologyController::class, 'update_pathology_test_details'])->name('update-pathology-test-details');
    });

    Route::get('add-pathology-report', [PathologyController::class, 'add_pathology_report'])->name('add-pathology-report');
});
// ================================== Pathology Main =================

// ================================== Radiology Main =================
Route::group(['middleware' => ['permission:radiology main'], 'prefix' => 'radiology'], function () {

    Route::get('radiology-details', [RadiologyController::class, 'radiology_details'])->name('radiology-details');
    Route::get('radiology-test-details', [RadiologyController::class, 'radiology_test_details'])->name('radiology-test-details');
    Route::post('find-range-by-parameter-radiology', [RadiologyController::class, 'find_range_by_parameter'])->name('find-range-by-parameter-radiology');
    Route::post('find-unit-by-parameter-radiology', [RadiologyController::class, 'find_unit_by_parameter'])->name('find-unit-by-parameter-radiology');

    Route::group(['middleware' => ['permission:add radiology test']], function () {
        Route::get('add-radiology-test-details', [RadiologyController::class, 'add_radiology_test_details'])->name('add-radiology-test-details');
        Route::post('save-radiology-test-details', [RadiologyController::class, 'save_radiology_test_details'])->name('save-radiology-test-details');
    });
    Route::group(['middleware' => ['permission:delete radiology test']], function () {
        Route::get('delete-radiology-test-details/{id}', [RadiologyController::class, 'delete_radiology_test_details'])->name('delete-radiology-test-details');
    });
    Route::group(['middleware' => ['permission:edit radiology test']], function () {
        Route::get('edit-radiology-test-details/{id}', [RadiologyController::class, 'edit_radiology_test_details'])->name('edit-radiology-test-details');
        Route::post('update-radiology-test-details', [RadiologyController::class, 'update_radiology_test_details'])->name('update-radiology-test-details');
    });
});
// ================================== Radiology Main =================

// ================================== Ambulance =================
Route::group(['middleware' => ['permission:ambulance']], function () {

    Route::get('ambulance-call-details', [AmbulanceController::class, 'ambulance_call_details'])->name('ambulance-call-details');
    Route::get('ambulance-details', [AmbulanceController::class, 'ambulance_details'])->name('ambulance-details');

    Route::group(['middleware' => ['permission:add ambulance']], function () {
        Route::get('add-ambulance-details', [AmbulanceController::class, 'add_ambulance_details'])->name('add-ambulance-details');
        Route::post('save-ambulance-details', [AmbulanceController::class, 'save_ambulance_details'])->name('save-ambulance-details');
    });
    Route::group(['middleware' => ['permission:delete radiology test']], function () {
        Route::get('delete-ambulance-details/{id}', [AmbulanceController::class, 'delete_ambulance_details'])->name('delete-ambulance-details');
    });
    Route::group(['middleware' => ['permission:edit radiology test']], function () {
        Route::get('edit-ambulance-details/{id}', [AmbulanceController::class, 'edit_ambulance_details'])->name('edit-ambulance-details');
        Route::post('update-ambulance-details', [AmbulanceController::class, 'update_ambulance_details'])->name('update-ambulance-details');
    });
    // ambulance call
    Route::post('find-driver-name-by-vehicial-model', [AmbulanceController::class, 'find_driver_name_by_vehical_model'])->name('find-driver-name-by-vehicial-model');


    Route::group(['middleware' => ['permission:add ambulance call']], function () {
        Route::get('add-ambulance-call-details', [AmbulanceController::class, 'add_ambulance_call_details'])->name('add-ambulance-call-details');
        Route::post('save-ambulance-call-details', [AmbulanceController::class, 'save_ambulance_call_details'])->name('save-ambulance-call-details');
    });
    Route::group(['middleware' => ['permission:delete ambulance call']], function () {
        Route::get('delete-ambulance-call-details/{id}', [AmbulanceController::class, 'delete_ambulance_call_details'])->name('delete-ambulance-call-details');
    });
    Route::group(['middleware' => ['permission:edit ambulance call']], function () {
        Route::get('edit-ambulance-call-details/{id}', [AmbulanceController::class, 'edit_ambulance_call_details'])->name('edit-ambulance-call-details');
        Route::post('update-ambulance-call-details', [AmbulanceController::class, 'update_ambulance_call_details'])->name('update-ambulance-call-details');
    });
});
// ================================== Ambulance =================
// Route::post('get-charge-category', [OpdController::class, 'get_charge_category'])->name('get-charge-category');
Route::post('get-subcategory-by-category', [BillingController::class, 'get_subcategory_by_category'])->name('get-subcategory-by-category');
Route::post('get-charge-name', [BillingController::class, 'get_charge_name'])->name('get-charge-name');
Route::post('get-category', [BillingController::class, 'get_category'])->name('get-category');
Route::post('get-charge-amount', [BillingController::class, 'get_charge_amount'])->name('get-charge-amount');
// ===========================================================================

// ===================================================================s==========

//================================= OPD ===================================================

Route::group(['middleware' => ['permission:OPD out-patients'], 'prefix' => 'opd'], function () {
    Route::get('OPD-Patient-list', [OpdController::class, 'index'])->name('OPD-Patient-list');
    Route::group(['middleware' => ['permission:OPD registation']], function () {
        Route::post('after-new-old', [OpdController::class, 'after_new_old'])->name('after-new-old');
        Route::post('add-opd-registration', [OpdController::class, 'add_opd_registation'])->name('add-opd-registration');

        Route::any('opd-registration/{id?}', [OpdController::class, 'opd_registation'])->name('opd-registration');
    });
    Route::group(['middleware' => ['permission:delete opd patient']], function () {
        Route::get('delete-opd-patient/{id}', [OpdController::class, 'deleteOPDdETAILS'])->name('delete-opd-patient');
    });
    Route::group(['middleware' => ['permission:edit opd patient']], function () {
        Route::get('edit-opd-patient/{id}', [OpdController::class, 'editOPDdETAILS'])->name('edit-opd-patient');
    });
    //================================= OPD profile ==================================
    Route::group(['middleware' => ['permission:OPD registation'], 'prefix' => 'opd-profile'], function () {
        Route::get('profile/{id}', [OpdController::class, 'profile'])->name('opd-profile');
    });
    //================================= OPD profile ====================================
    //================================= OPD billing ====================================
    Route::group(['middleware' => ['permission:opd billing'], 'prefix' => 'opd-billing'], function () {
        Route::get('opd-billing/{id}', [BillingController::class, 'index'])->name('opd-billing');
        Route::group(['middleware' => ['permission:add opd billing']], function () {
            Route::get('add-opd-billing/{id}', [BillingController::class, 'create_billing'])->name('add-opd-billing');
            Route::post('add-new-opd-billing', [BillingController::class, 'save_new_opd_billing'])->name('add-new-opd-billing');
        });
        Route::get('opd-bill-details/{bill_id}', [BillingController::class, 'bill_details'])->name('opd-bill-details');
        Route::group(['middleware' => ['permission:edit opd billing']], function () {
            Route::get('edit-opd-bill/{bill_id}', [BillingController::class, 'edit_opd_bill'])->name('edit-opd-bill');
        });
        Route::group(['middleware' => ['permission:delete opd billing']], function () {
            Route::get('delete-opd-bill/{bill_id}', [BillingController::class, 'delete_opd_bill'])->name('delete-opd-bill');
        });
    });
    //================================= OPD billing ====================================

    //================================= OPD timeline ====================================
    Route::group(['middleware' => ['permission:timeline list opd'], 'prefix' => 'opd-timeline'], function () {
        Route::get('timeline-lisitng-in-opd/{id}', [TimelineController::class, 'timeline_listing_opd'])->name('timeline-lisitng-in-opd');
        Route::group(['middleware' => ['permission:add timeline list opd']], function () {
            Route::get('add-timeline-lisitng-in-opd/{id}', [TimelineController::class, 'add_timeline_listing_opd'])->name('add-timeline-lisitng-in-opd');
            Route::post('save-timeline-lisitng-in-opd', [TimelineController::class, 'save_timeline_listing_opd'])->name('save-timeline-lisitng-in-opd');
        });
        Route::group(['middleware' => ['permission:delete timeline list opd']], function () {
            Route::get('delete-timeline-lisitng-in-opd/{id}', [TimelineController::class, 'delete_timeline_listing_opd'])->name('delete-timeline-lisitng-in-opd');
        });
        Route::group(['middleware' => ['permission:edit timeline list opd']], function () {
            Route::get('edit-timeline-lisitng-in-opd/{id}/{opd_id}', [TimelineController::class, 'edit_timeline_listing_opd'])->name('edit-timeline-lisitng-in-opd');
            Route::post('update-timeline-lisitng-in-opd', [TimelineController::class, 'update_timeline_listing_opd'])->name('update-timeline-lisitng-in-opd');
            Route::post('find-timeline-details', [TimelineController::class, 'find_timeline_details'])->name('find-timeline-details');
        });
    });
    //================================= OPD timeline ====================================

    //================================= OPD payment ====================================
    Route::group(['middleware' => ['permission:opd payment'], 'prefix' => 'opd-payment'], function () {
        Route::get('payment-listing-in-opd/{id}', [OpdPaymentController::class, 'payment_listing_in_opd'])->name('payment-listing-in-opd');
        Route::group(['middleware' => ['permission:add opd payment']], function () {
            Route::get('add-payment-in-opd/{id}', [OpdPaymentController::class, 'add_payment_in_opd'])->name('add-payment-in-opd');
            Route::post('save-payment-in-opd', [OpdPaymentController::class, 'save_payment_in_opd'])->name('save-payment-in-opd');
        });
        Route::group(['middleware' => ['permission:delete opd payment']], function () {
            Route::get('delete-payment-in-opd/{id}', [OpdPaymentController::class, 'delete_payment_in_opd'])->name('delete-payment-in-opd');
        });
        Route::group(['middleware' => ['permission:edit opd payment']], function () {
            Route::get('edit-payment-in-opd/{id}/{opd_id}', [OpdPaymentController::class, 'edit_payment_in_opd'])->name('edit-payment-in-opd');
            Route::post('update-payment-in-opd', [OpdPaymentController::class, 'update_payment_in_opd'])->name('update-payment-in-opd');
        });
    });
    //================================= OPD payment ====================================

    //================================= OPD Physical Condition ====================================
    Route::group(['middleware' => ['permission:opd physical condition'], 'prefix' => 'opd-physical-condition'], function () {
        Route::get('physical-condition-in-opd/{id}', [PhysicalConditionController::class, 'physical_condition_listing_in_opd'])->name('physical-condition-in-opd');
        Route::group(['middleware' => ['permission:add opd physical condition']], function () {
            Route::get('add-physical-condition-in-opd/{id}', [PhysicalConditionController::class, 'add_physical_condition_opd'])->name('add-physical-condition-in-opd');
            Route::post('save-physical-condition-in-opd', [PhysicalConditionController::class, 'save_physical_condition_opd'])->name('save-physical-condition-in-opd');
        });
        Route::group(['middleware' => ['permission:delete physical condition']], function () {
            Route::get('delete-physical-condition-in-opd/{id}', [PhysicalConditionController::class, 'delete_physical_condition_opd'])->name('delete-physical-condition-in-opd');
        });
        Route::group(['middleware' => ['permission:edit physical condition']], function () {
            Route::get('edit-physical-condition-in-opd/{id}/{opd_id}', [PhysicalConditionController::class, 'edit_physical_condition_opd'])->name('edit-physical-condition-in-opd');
            Route::post('update-physical-condition-in-opd', [PhysicalConditionController::class, 'update_physical_condition_opd'])->name('update-physical-condition-in-opd');
            Route::post('find-timeline-details', [PhysicalConditionController::class, 'find_timeline_details'])->name('find-timeline-details');
        });
    });
    //================================= OPD Physical Condition ====================================

    //================================= ipd admission from opd ==========================
    Route::group(['middleware' => ['permission:Admission From OPD']], function () {
        Route::get('admission-from-opd/{id}', [OpdController::class, 'admission_from_opd'])->name('ipd-registation-from-opd');
    });
    //================================= ipd admission from opd ==========================

    Route::post('patient_search-in-opd', [OpdController::class, 'patient_search_in_opd'])->name('patient_search-in-opd');
    Route::post('find-symptoms-title-by-symptoms-type', [OpdController::class, 'find_symptoms_title_by_symptoms_type'])->name('find-symptoms-title-by-symptoms-type');

    // Route::get('payment-list/{id}', [OpdController::class, 'payment_list'])->name('payment-list');
    Route::post('find-doctor-by-department', [OpdController::class, 'find_doctor_by_department'])->name('find-doctor-by-department');
    Route::post('patient-edit-age', [OpdController::class, 'patient_edit_age'])->name('patient-age-edit');
});


//================================= OPD ===================================================


//================================= Emg ===================================================
Route::group(['middleware' => ['permission:Emg patients'], 'prefix' => 'emg'], function () {
    Route::get('emg-patient-list', [EmgController::class, 'index'])->name('emg-patient-list');
    Route::group(['middleware' => ['permission:OPD registation']], function () {
        Route::post('emg-after-new-old', [EmgController::class, 'after_new_old'])->name('emg-after-new-old');

        Route::any('emg-registation/{patientid?}', [EmgController::class, 'emg_registation'])->name('emg-registation');
        Route::post('add-emg-registation', [EmgController::class, 'add_emg_registation'])->name('add-emg-registation');
    });
    Route::group(['middleware' => ['permission:emg patient profile']], function () {
        Route::get('emg-profile/{id}', [EmgController::class, 'profile'])->name('emg-patient-profile');
    });
    Route::group(['middleware' => ['permission:Admission From EMG']], function () {
        Route::get('admission-from-emg/{id}', [EmgController::class, 'admission_from_emg'])->name('ipd-registation-from-emg');
    });
});


//================================= emg Physical Condition ====================================
Route::group(['middleware' => ['permission:emg physical condition'], 'prefix' => 'emg-physical-condition'], function () {
    Route::get('physical-condition-in-emg/{id}', [PhysicalConditionController::class, 'physical_condition_listing_in_emg'])->name('physical-condition-in-emg');
    Route::group(['middleware' => ['permission:add emg physical condition']], function () {
        Route::get('add-physical-condition-in-emg/{id}', [PhysicalConditionController::class, 'add_physical_condition_emg'])->name('add-physical-condition-in-emg');
        Route::post('save-physical-condition-in-emg', [PhysicalConditionController::class, 'save_physical_condition_emg'])->name('save-physical-condition-in-emg');
    });
    Route::group(['middleware' => ['permission:delete emg physical condition']], function () {
        Route::get('delete-physical-condition-in-emg/{id}', [PhysicalConditionController::class, 'delete_physical_condition_emg'])->name('delete-physical-condition-in-emg');
    });
    Route::group(['middleware' => ['permission:edit emg physical condition']], function () {
        Route::get('edit-physical-condition-in-emg/{id}/{emg_id}', [PhysicalConditionController::class, 'edit_physical_condition_emg'])->name('edit-physical-condition-in-emg');
        Route::post('update-physical-condition-in-emg', [PhysicalConditionController::class, 'update_physical_condition_emg'])->name('update-physical-condition-in-emg');
    });
});
//================================= emg Physical Condition ==========================

//================================= emg timeline ====================================
Route::group(['middleware' => ['permission:timeline list emg'], 'prefix' => 'emg-timeline'], function () {
    Route::get('timeline-lisitng-in-emg/{id}', [TimelineController::class, 'timeline_listing_emg'])->name('timeline-lisitng-in-emg');
    Route::group(['middleware' => ['permission:add timeline list emg']], function () {
        Route::get('add-timeline-lisitng-in-emg/{id}', [TimelineController::class, 'add_timeline_listing_emg'])->name('add-timeline-lisitng-in-emg');
        Route::post('save-timeline-lisitng-in-emg', [TimelineController::class, 'save_timeline_listing_emg'])->name('save-timeline-lisitng-in-emg');
    });
    Route::group(['middleware' => ['permission:delete timeline list emg']], function () {
        Route::get('delete-timeline-lisitng-in-emg/{id}', [TimelineController::class, 'delete_timeline_listing_emg'])->name('delete-timeline-lisitng-in-emg');
    });
    Route::group(['middleware' => ['permission:edit timeline list emg']], function () {
        Route::get('edit-timeline-lisitng-in-emg/{id}/{emg_id}', [TimelineController::class, 'edit_timeline_listing_emg'])->name('edit-timeline-lisitng-in-emg');
        Route::post('update-timeline-lisitng-in-emg', [TimelineController::class, 'update_timeline_listing_emg'])->name('update-timeline-lisitng-in-emg');
        Route::post('find-timeline-details', [TimelineController::class, 'find_timeline_details'])->name('find-timeline-details');
    });
});

//================================= emg timeline ===================================

//================================= Emg payment ====================================
Route::group(['middleware' => ['permission:emg payment'], 'prefix' => 'emg-payment'], function () {
    Route::get('payment-listing-in-emg/{id}', [EmgPaymentController::class, 'payment_listing_in_emg'])->name('payment-listing-in-emg');
    Route::group(['middleware' => ['permission:add emg payment']], function () {
        Route::get('add-payment-in-emg/{id}', [EmgPaymentController::class, 'add_payment_in_emg'])->name('add-payment-in-emg');
        Route::post('save-payment-in-emg', [EmgPaymentController::class, 'save_payment_in_emg'])->name('save-payment-in-emg');
    });
    Route::group(['middleware' => ['permission:delete emg payment']], function () {
        Route::get('delete-payment-in-emg/{id}', [EmgPaymentController::class, 'delete_payment_in_emg'])->name('delete-payment-in-emg');
    });
    Route::group(['middleware' => ['permission:edit emg payment']], function () {
        Route::get('edit-payment-in-emg/{id}/{emg_id}', [EmgPaymentController::class, 'edit_payment_in_emg'])->name('edit-payment-in-emg');
        Route::post('update-payment-in-emg', [EmgPaymentController::class, 'update_payment_in_emg'])->name('update-payment-in-emg');
    });
});
//================================= Emg payment ====================================

//================================= Emg ============================================


//====================== FindingCategory ===========================================
Route::group(['middleware' => ['permission:Finding']], function () {
    Route::group(['middleware' => ['permission:finding category']], function () {
        Route::get('finding-category-add', [FindingController::class, 'add'])->name('finding-category-add');
        Route::group(['middleware' => ['permission:add finding category']], function () {
            Route::post('finding-category-save', [FindingController::class, 'save'])->name('finding-category-save');
        });
        Route::group(['middleware' => ['permission:delete finding category']], function () {
            Route::get('delete-finding-category/{id}', [FindingController::class, 'delete'])->name('delete-finding-category');
        });
        Route::group(['middleware' => ['permission:edit finding category']], function () {
            Route::get('edit-finding-category/{id}', [FindingController::class, 'edit'])->name('edit-finding-category');
            Route::post('finding-category-update', [FindingController::class, 'update'])->name('finding-category-update');
        });
    });

    Route::get('finding', [FindingController::class, 'add_finding'])->name('finding');
    Route::group(['middleware' => ['permission:add finding']], function () {
        Route::post('save-finding', [FindingController::class, 'save_finding'])->name('save-finding');
    });
    Route::group(['middleware' => ['permission:edit finding']], function () {
        Route::get('edit-finding/{id}', [FindingController::class, 'edit_finding'])->name('edit-finding');
        Route::post('update-finding', [FindingController::class, 'update_finding'])->name('update-finding');
    });
    Route::group(['middleware' => ['permission:delete finding']], function () {
        Route::get('delete-finding/{id}', [FindingController::class, 'delete_finding'])->name('delete-finding');
    });
});
//====================== FindingCategory ========================================

//================================= Appointment ===================================================
Route::group(['middleware' => ['permission:appointment main']], function () {
    Route::get('all-appointments-details', [AppointmentController::class, 'appointments_details'])->name('all-appointments-details');
    Route::post('find-fees-by-doctor', [AppointmentController::class, 'find_doctor_fees_by_doctor'])->name('find-fees-by-doctor');

    Route::group(['middleware' => ['permission:add appointment']], function () {
        Route::get('add-appointments-details', [AppointmentController::class, 'add_appointments_details'])->name('add-appointments-details');
        Route::post('save-appointments-details', [AppointmentController::class, 'save_appointments_details'])->name('save-appointments-details');
    });
    Route::group(['middleware' => ['permission:edit appointment']], function () {
        Route::get('edit-appointments-details/{id}', [AppointmentController::class, 'edit_appointments_details'])->name('edit-appointments-details');
        Route::post('update-appointments-details', [AppointmentController::class, 'update_appointments_details'])->name('update-appointments-details');
    });
    Route::group(['middleware' => ['permission:delete appointment']], function () {
        Route::get('delete-appointments-details/{id}', [AppointmentController::class, 'delete_appointments_details'])->name('delete-appointments-details');
    });
});
//================================= Appointment ===================================================


//================================= Front Office ===================================================
Route::group(['middleware' => ['permission:front office']], function () {
    Route::get('all-visit-details', [VisitController::class, 'visit_details'])->name('all-visit-details');
    Route::post('find-staff-by-visitor', [VisitController::class, 'find_staff_by_visitor'])->name('find-staff-by-visitor');

    Route::group(['middleware' => ['permission:add appointment']], function () {
        Route::get('add-visit-details', [VisitController::class, 'add_visit_details'])->name('add-visit-details');
        Route::post('save-visit-details', [VisitController::class, 'save_visit_details'])->name('save-visit-details');
    });
    Route::group(['middleware' => ['permission:edit appointment']], function () {
        Route::get('edit-visit-details/{id}', [VisitController::class, 'edit_visit_details'])->name('edit-visit-details');
        Route::post('update-visit-details', [VisitController::class, 'update_visit_details'])->name('update-visit-details');
    });
    Route::group(['middleware' => ['permission:delete appointment']], function () {
        Route::get('delete-visit-details/{id}', [VisitController::class, 'delete_visit_details'])->name('delete-visit-details');
    });

    //================================= Call Log ===================================================
    Route::group(['middleware' => ['permission:call log']], function () {
        Route::get('all-phone-call-log-details', [VisitController::class, 'all_phone_call_log_listing'])->name('all-phone-call-log-details');
        // Route::post('find-fees-by-doctor', [AppointmentController::class, 'find_doctor_fees_by_doctor'])->name('find-fees-by-doctor');

        Route::group(['middleware' => ['permission:add call log']], function () {
            Route::get('add-call-log-details', [VisitController::class, 'add_call_log_details'])->name('add-call-log-details');
            Route::post('save-call-log-details', [VisitController::class, 'save_call_log_details'])->name('save-call-log-details');
        });
        Route::group(['middleware' => ['permission:edit call log']], function () {
            Route::get('edit-call-log-details/{id}', [VisitController::class, 'edit_call_log_details'])->name('edit-call-log-details');
            Route::post('update-call-log-details', [VisitController::class, 'update_call_log_details'])->name('update-call-log-details');
        });
        Route::group(['middleware' => ['permission:delete call log']], function () {
            Route::get('delete-call-log-details/{id}', [VisitController::class, 'delete_call_log_details'])->name('delete-call-log-details');
        });
    });
    //================================= Call Log ===================================================

    //================================= Complain ===================================================
    Route::group(['middleware' => ['permission:complain'], ['prefix' => 'complain']], function () {
        Route::get('all-complain-details', [ComplainController::class, 'all_complain_listing'])->name('all-complain-details');

        Route::group(['middleware' => ['permission:add complain']], function () {
            Route::get('add-complain-details', [ComplainController::class, 'add_complain_details'])->name('add-complain-details');
            Route::post('save-complain-details', [ComplainController::class, 'save_complain_details'])->name('save-complain-details');
        });
        Route::group(['middleware' => ['permission:edit complain']], function () {
            Route::get('edit-complain-details/{id}', [ComplainController::class, 'edit_complain_details'])->name('edit-complain-details');
            Route::post('update-complain-details', [ComplainController::class, 'update_complain_details'])->name('update-complain-details');
        });
        Route::group(['middleware' => ['permission:delete complain']], function () {
            Route::get('delete-complain-details/{id}', [ComplainController::class, 'delete_complain_details'])->name('delete-complain-details');
        });
    });
    //================================= Complain ===================================================

    //================================= Postal Receive ============================================
    Route::group(['middleware' => ['permission:postal receive'], ['prefix' => 'postal receive']], function () {
        Route::get('all-postal-receive-details', [PostalController::class, 'all_postal_receive_listing'])->name('all-postal-receive-details');

        Route::group(['middleware' => ['permission:add postal receive']], function () {
            Route::get('add-postal-receive-details', [PostalController::class, 'add_postal_receive_details'])->name('add-postal-receive-details');
            Route::post('save-postal-receive-details', [PostalController::class, 'save_postal_receive_details'])->name('save-postal-receive-details');
        });
        Route::group(['middleware' => ['permission:edit postal receive']], function () {
            Route::get('edit-postal-receive-details/{id}', [PostalController::class, 'edit_postal_receive_details'])->name('edit-postal-receive-details');
            Route::post('update-postal-receive-details', [PostalController::class, 'update_postal_receive_details'])->name('update-postal-receive-details');
        });
        Route::group(['middleware' => ['permission:delete postal receive']], function () {
            Route::get('delete-postal-receive-details/{id}', [PostalController::class, 'delete_postal_receive_details'])->name('delete-postal-receive-details');
        });
    });
    //================================= Postal Receive =============================================


    //================================= Postal Dispatch ============================================
    Route::group(['middleware' => ['permission:postal dispatch'], ['prefix' => 'postal dispatch']], function () {
        Route::get('all-postal-dispatch-details', [DispatchController::class, 'all_postal_dispatch_listing'])->name('all-postal-dispatch-details');
        Route::group(['middleware' => ['permission:add postal dispatch']], function () {
            Route::get('add-postal-dispatch-details', [DispatchController::class, 'add_postal_dispatch_details'])->name('add-postal-dispatch-details');
            Route::post('save-postal-dispatch-details', [DispatchController::class, 'save_postal_dispatch_details'])->name('save-postal-dispatch-details');
        });
        Route::group(['middleware' => ['permission:edit postal dispatch']], function () {
            Route::get('edit-postal-dispatch-details/{id}', [DispatchController::class, 'edit_postal_dispatch_details'])->name('edit-postal-dispatch-details');
            Route::post('update-postal-dispatch-details', [DispatchController::class, 'update_postal_dispatch_details'])->name('update-postal-dispatch-details');
        });
        Route::group(['middleware' => ['permission:delete postal dispatch']], function () {
            Route::get('delete-postal-dispatch-details/{id}', [DispatchController::class, 'delete_postal_dispatch_details'])->name('delete-postal-dispatch-details');
        });
    });
    //================================= Postal Receive =============================================


});
//================================= Front Office ============================================

//================================= Ipd ===================================================
Route::group(['middleware' => ['permission:IPD ipd-patients'], 'prefix' => 'ipd'], function () {
    Route::get('ipd-patient-listing', [IpdController::class, 'index'])->name('ipd-patient-listing');

    Route::group(['middleware' => ['permission:IPD registation']], function () {
        Route::post('ipd-registation', [IpdController::class, 'ipd_registation'])->name('ipd-registation');
    });

    Route::group(['middleware' => ['permission:IPD profile'], 'prefix' => 'ipd-profile'], function () {
        Route::get('ipd-profile/{id}', [IpdController::class, 'profile'])->name('ipd-profile');
    });
    Route::post('ipd-patient-status-change', [IpdController::class, 'ipd_patient_status_change'])->name('ipd-patient-status-change');

    Route::post('find-doctor-and-ward-by-department-in-ipd', [IpdController::class, 'find_doctor_and_ward_by_department_in_opd'])->name('find-doctor-and-ward-by-department-in-ipd');

    Route::post('find-bed-by-bed-ward', [IpdController::class, 'find_bed_by_bed_ward'])->name('find-bed-by-bed-ward');

    // Route::post('find-bed-type-by-department-in-ipd', [IpdController::class, 'find_bed_type_by_department_in_opd'])->name('find-bed-type-by-department-in-ipd');

    // =============================== Timeline ipd ==================================================
    Route::group(['middleware' => ['permission:ipd timeline'], 'prefix' => 'ipd-timeline'], function () {
        Route::group(['middleware' => ['permission:timeline list ipd']], function () {
            Route::get('timeline-lisitng-in-ipd/{ipd_id}', [TimelineController::class, 'timeline_listing_ipd'])->name('timeline-lisitng-in-ipd');
        });
        Route::group(['middleware' => ['permission:add timeline ipd']], function () {
            Route::get('add-timeline-ipd/{ipd_id}', [TimelineController::class, 'add_timeline_ipd'])->name('add-timeline-ipd');
            Route::post('save-timeline-lisitng-in-ipd', [TimelineController::class, 'save_timeline_listing_ipd'])->name('save-timeline-lisitng-in-ipd');
        });
    });

    Route::group(['middleware' => ['permission:delete timeline list ipd']], function () {
        Route::get('delete-timeline-lisitng-in-ipd/{id}', [TimelineController::class, 'delete_timeline_listing_ipd'])->name('delete-timeline-lisitng-in-ipd');
    });
    Route::group(['middleware' => ['permission:edit timeline list ipd']], function () {
        Route::get('edit-timeline-lisitng-in-ipd/{id}', [TimelineController::class, 'edit_timeline_listing_ipd'])->name('edit-timeline-lisitng-in-ipd');
        Route::post('update-timeline-lisitng-in-ipd', [
            TimelineController::class,
            'update_timeline_listing_ipd'
        ])->name('update-timeline-lisitng-in-ipd');

        Route::post('find-timeline-details-ipd', [TimelineController::class, 'find_timeline_details_ipd'])->name('find-timeline-details-ipd');
    });

    // =============================== Timeline ipd ====================================================

    // =============================== Bed Transfar ==================================================

    Route::group(['middleware' => ['permission:add bed transfar history']], function () {
        Route::post('save-bed-transfar-history', [BedTransfarController::class, 'save_bed_transfar_history'])->name('save-bed-transfar-history');
    });
    Route::group(['middleware' => ['permission:delete bed transfar history']], function () {
        Route::get('delete-bed-transfar-history/{id}', [BedTransfarController::class, 'delete_bed_transfar_history'])->name('delete-bed-transfar-history');
    });
    Route::group(['middleware' => ['permission:edit bed transfar history']], function () {
        Route::get('edit-bed-transfar-history/{id}', [BedTransfarController::class, 'edit_bed_transfar_history'])->name('edit-bed-transfar-history');
        Route::post('update-bed-transfar-history', [
            BedTransfarController::class,
            'update_bed_transfar_history'
        ])->name('update-bed-transfar-history');

        Route::post('find-patient-bed-history', [BedTransfarController::class, 'find_bed_history_details_ipd'])->name('find-patient-bed-history');
    });

    // =============================== Bed Transfar ====================================================

    // =============================== Nurse Note ==================================================
    Route::group(['middleware' => ['permission:add nurse note']], function () {
        Route::post('save-nurse-note-details', [NurseNoteController::class, 'save_nurse_note_details'])->name('save-nurse-note-details');
    });
    // =============================== Nurse Note ==================================================

    // =============================== Medication ==================================================
    Route::group(['middleware' => ['permission:save medication']], function () {
        Route::get('show-medicaiton-dose/{ipd_id}', [MedicationController::class, 'show_medicaiton_dose'])->name('show-medicaiton-dose');

        Route::get('add-medicaiton-dose/{ipd_id}', [MedicationController::class, 'add_medicaiton_dose'])->name('add-medicaiton-dose');


        Route::post('save-medicaiton-dose', [MedicationController::class, 'save_medicaiton_dose'])->name('save-medicaiton-dose');
        Route::post('find-medicine-name-by-medicine-catagory', [MedicationController::class, 'find_medicine_name_by_medicine_catagory'])->name('find-medicine-name-by-medicine-catagory');
        Route::post('find-dosage-by-medicine-catagory', [MedicationController::class, 'find_dosage_by_medicine_catagory'])->name('find-dosage-by-medicine-catagory');
        Route::post('find-medication-details', [MedicationController::class, 'find_medication_details'])->name('find-medication-details');
        Route::post('find-dosage-and-name-by-medicine-catagory', [MedicationController::class, 'find_medication_name_dose_details'])->name('find-dosage-and-name-by-medicine-catagory');
    });
    // =============================== Medication ==================================================

    // =============================== OxygenMonitoring ==================================================
    Route::group(['middleware' => ['permission:save oxygen monitoring']], function () {
        Route::get('add-oxygen-monitoring-details/{ipd_id}', [OxygenMonitoringController::class, 'add_oxygen_monitoring_details'])->name('add-oxygen-monitoring-details');

        Route::post('save-oxygen-monitoring-details', [OxygenMonitoringController::class, 'save_oxygen_monitoring_details'])->name('save-oxygen-monitoring-details');


        Route::get('delete-oxygen-monitoring/{id}', [OxygenMonitoringController::class, 'delete_oxygen_monitoring'])->name('delete-oxygen-monitoring');
    });
    // ================================= OxygenMonitoring ==================================================

    // =============================== Ipd - Operation ==================================================
    Route::group(['middleware' => ['permission:save operation theatre']], function () {
        Route::post('save-ipd-operation-details', [OperationTheatreController::class, 'save_ipd_operation_details'])->name('save-ipd-operation-details');
        Route::post('find-operation-type-and-catagory-by-department', [OperationTheatreController::class, 'find_operation_type_and_name_by_department'])->name('find-operation-type-and-catagory-by-department');
        Route::post('find-operation-name-by-operation-catagory', [OperationTheatreController::class, 'find_operation_name_by_operation_catagory'])->name('find-operation-name-by-operation-catagory');
    });
    // =============================== Ipd - Operation ==================================================

    // =============================== ipd payment ==================================================
    Route::group(['middleware' => ['permission:save ipd payment']], function () {
        Route::post('save-ipd-payment-details', [IpdPaymentController::class, 'save_ipd_payment_details'])->name('save-ipd-payment-details');
    });
    // ================================ ipd payment ==================================================

    // =============================== ipd charges ==================================================
    Route::group(['middleware' => ['permission:save ipd payment']], function () {
        Route::post('save-ipd-charges-details', [IpdChargeController::class, 'save_ipd_charges_details'])->name('save-ipd-charges-details');
    });
    // ================================ ipd charges =================================================

});
//================================= Ipd ===================================================

//================================= Discount ===================================================
Route::group(['middleware' => ['permission:discount'], 'prefix' => 'discount'], function () {
    Route::get('discount-list', [DiscountController::class, 'discount_list'])->name('discount-list');
    Route::get('discount-details/{discount_id}', [DiscountController::class, 'discount_details'])->name('view-discount-details');
    Route::post('given-discount', [DiscountController::class, 'given_discount'])->name('given-discount');
});
//================================= Discount ===================================================
