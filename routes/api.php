<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [Controllers\UserController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('logout', [Controllers\UserController::class, 'logout']);
    //Users
    Route::get('users', [Controllers\UserController::class, 'index']);
    Route::post('user', [Controllers\UserController::class, 'store']);
    Route::get('user/{id}', [Controllers\UserController::class, 'show']);
    Route::put('user', [Controllers\UserController::class, 'change_password']);

    //Roles
    Route::get('roles', [Controllers\RoleController::class, 'index']);
    Route::post('role', [Controllers\RoleController::class, 'store']);
    Route::get('role/{id}', [Controllers\RoleController::class, 'show']);

    //MHEIs
    Route::get('mheis', [Controllers\MheiController::class, 'index']);
    Route::post('mhei', [Controllers\MheiController::class, 'store']);
    Route::get('mhei/{id}', [Controllers\MheiController::class, 'show']);
    
    //MHEI Staffs
    Route::get('mhei-staffs', [Controllers\MheiStaffsController::class, 'index']);
    Route::post('mhei-staff', [Controllers\MheiStaffsController::class, 'store']);
    Route::get('mhei-staff/{id}', [Controllers\MheiStaffsController::class, 'show']);

    //MaritimeProgram
    Route::get('maritime-programs', [Controllers\MaritimeProgramController::class, 'index']);
    Route::post('maritime-program', [Controllers\MaritimeProgramController::class, 'store']);
    Route::get('maritime-program/{id}', [Controllers\MaritimeProgramController::class, 'show']);

    //ShippingCompany
    Route::get('shipping-companys', [Controllers\ShippingCompanyController::class, 'index']);
    Route::post('shipping-company', [Controllers\ShippingCompanyController::class, 'store']);
    Route::get('shipping-company/{id}', [Controllers\ShippingCompanyController::class, 'show']);

    //ShippingCompanyStaffs
    Route::get('shipping-company-staffs', [Controllers\ShippingCompanyStaffsController::class, 'index']);
    Route::post('shipping-company-staff', [Controllers\ShippingCompanyStaffsController::class, 'store']);
    Route::get('shipping-company-staff/{id}', [Controllers\ShippingCompanyStaffsController::class, 'show']);

    //Vessels
    Route::get('vessels', [Controllers\VesselController::class, 'index']);
    Route::post('vessel', [Controllers\VesselController::class, 'store']);
    Route::get('vessel/{id}', [Controllers\VesselController::class, 'show']);

    //VesselStaffs
    Route::get('vessel-staffs', [Controllers\VesselStaffsController::class, 'index']);
    Route::post('vessel-staff', [Controllers\VesselStaffsController::class, 'store']);
    Route::get('vessel-staff/{id}', [Controllers\VesselStaffsController::class, 'show']);

    //ChedStaffs
    Route::get('ched-staffs', [Controllers\ChedStaffsController::class, 'index']);
    Route::post('ched-staff', [Controllers\ChedStaffsController::class, 'store']);
    Route::get('ched-staff/{id}', [Controllers\ChedStaffsController::class, 'show']);

    //PcgStaffs
    Route::get('pcg-staffs', [Controllers\PcgStaffsController::class, 'index']);
    Route::post('pcg-staff', [Controllers\PcgStaffsController::class, 'store']);
    Route::get('pcg-staff/{id}', [Controllers\PcgStaffsController::class, 'show']);

    //MarinaStaffs
    Route::get('marina-staffs', [Controllers\MarinaStaffsController::class, 'index']);
    Route::post('marina-staff', [Controllers\MarinaStaffsController::class, 'store']);
    Route::get('marina-staff/{id}', [Controllers\MarinaStaffsController::class, 'show']);

    //Students
    Route::get('students', [Controllers\StudentController::class, 'index']);
    Route::post('student', [Controllers\StudentController::class, 'store']);
    Route::get('student/{id}', [Controllers\StudentController::class, 'show']);

    //OBTRequests
    Route::get('obt-applications', [Controllers\ObtApplicationsController::class, 'index']);
    Route::post('obt-application', [Controllers\ObtApplicationsController::class, 'store']);
    Route::get('obt-application/{id}', [Controllers\ObtApplicationsController::class, 'show']);
});