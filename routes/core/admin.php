<?php

use App\Http\Controllers\Core\DashboardController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::group(['middleware' => ['first_login']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});