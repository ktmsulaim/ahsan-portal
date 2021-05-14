<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuth\LoginController;
use App\Http\Controllers\AdminAuth\RegisterController;
use App\Http\Controllers\AdminAuth\ForgotPasswordController;
use App\Http\Controllers\AdminAuth\ResetPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\CampaignController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout.post');


Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.request');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('admin.password.email');
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.reset');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);

Route::middleware('admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    /**
     * ---------------------------------------------------------------------
     * Members management
     * ---------------------------------------------------------------------
     */
    Route::get('/members', [AdminUsersController::class, 'index'])->name('admin.users.index');
    Route::get('/members/ajax/{batch}', [AdminUsersController::class, 'dtIndex'])->name('admin.users.dtIndex');
    Route::get('/members/create', [AdminUsersController::class, 'create'])->name('admin.users.create');
    Route::post('/members', [AdminUsersController::class, 'store'])->name('admin.users.store');
    Route::get('/members/{user}', [AdminUsersController::class, 'show'])->name('admin.users.show');
    Route::get('/members/{user}/edit', [AdminUsersController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/members/{user}', [AdminUsersController::class, 'update'])->name('admin.users.update');
    Route::delete('/members/{user}', [AdminUsersController::class, 'destroy'])->name('admin.users.delete');

    Route::post('/members/import', [AdminUsersController::class, 'import'])->name('admin.users.import');

    Route::post('/members/bulkupdate/batch', [AdminUsersController::class, 'bulkupdate'])->name('admin.users.bulkupdate');

    Route::resource('campaigns', CampaignController::class, ['as' => 'admin']);
});