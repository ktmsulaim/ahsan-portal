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
use App\Http\Controllers\LetterpadPrintController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\SponsorsExportController;
use App\Http\Controllers\UserApplicationController;
use App\Models\UserApplication;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout.post');


Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.request');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('admin.password.email');
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.reset');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);

Route::middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/changePassword', [AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('/changePassword', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');

    /**
     * ---------------------------------------------------------------------
     * Members management
     * ---------------------------------------------------------------------
     */

    // Applications
    Route::get('/members/applications', [UserApplicationController::class, 'index'])->name('admin.users.applications.index');
    Route::get('/members/applications/ajax/{status}', [UserApplicationController::class, 'dtIndex'])->name('admin.users.applications.dtIndex');

    Route::get('/members/applications/{user_application}', [UserApplicationController::class, 'show'])->name('admin.users.applications.show');
    Route::post('/members/applications/{user_application}', [UserApplicationController::class, 'updateStatus'])->name('admin.users.applications.updateStatus');

    // All members
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

    Route::get('/campaigns/{campaign}/sponsors/export', [SponsorsExportController::class, 'export'])->name('admin.sponsors.export');

    Route::resource('campaigns', CampaignController::class, ['as' => 'admin']);



    /**
     * ---------------------------------------------------------------------
     * Sponsors management
     * ---------------------------------------------------------------------
     */
    Route::resource('sponsors', SponsorController::class, ['as' => 'admin'])->except(['index']);

    Route::get('/sponsors/campaigns/{campaign}', [SponsorController::class, 'index'])->name('admin.sponsors.index');

    Route::get('/members/{user}/campaigns/{campaign}', [SponsorController::class, 'byUser'])->name('admin.sponsors.byUser');
    Route::post('/members/{user}/campaigns/{campaign}/location', [SponsorController::class, 'updateUserCampaignLocation'])->name('admin.user-campaign.updateLocation');
    Route::get('/members/{user}/campaigns/{campaign}/sponsors', [SponsorController::class, 'dtByUser'])->name('admin.sponsors.dtByUser');

    /**
     * ---------------------------------------------------------------------
     * Letterpad printing
     * ---------------------------------------------------------------------
     */
    Route::get('/sponsors/{sponsor}/print/', [LetterpadPrintController::class, 'print'])->name('admin.sponsors.letterpad.print');

    /**
     * ---------------------------------------------------------------------
     * Reports
     * ---------------------------------------------------------------------
     */
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/reports/show', [ReportController::class, 'show'])->name('admin.reports.show');
    Route::get('/reports/whatsapp', [ReportController::class, 'whatsappIndex'])->name('admin.reports.whatsapp');
    Route::get('/reports/whatsapp/show', [ReportController::class, 'whatsappShow'])->name('admin.reports.whatsapp.show');

    /**
     * ---------------------------------------------------------------------
     * Settings
     * ---------------------------------------------------------------------
     */
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
});
