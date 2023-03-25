<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LetterpadPrintController;
use App\Http\Controllers\MembershipApplyController;
use App\Http\Controllers\SponsorsExportController;
use App\Http\Controllers\UserCampaignsController;
use App\Http\Controllers\UserSponsorsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect()->route('login');
})->name('welcome');

Auth::routes(['register' => false]);

/*
|--------------------------------------------------------------------------
| Apply for membership
|--------------------------------------------------------------------------
*/

Route::get('/membership/apply', [MembershipApplyController::class, 'apply'])->name('membership.apply');
Route::post('/membership/store', [MembershipApplyController::class, 'store'])->name('membership.store');
Route::get('/membership/status', [MembershipApplyController::class, 'status'])->name('membership.status');
Route::post('/membership/status', [MembershipApplyController::class, 'getStatus'])->name('membership.getStatus');


Route::middleware(['auth', 'campaign.select'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [HomeController::class, 'updateProfile'])->name('profile.update');

    Route::get('/changePassword', [HomeController::class, 'changePassword'])->name('user.changePassword');
    Route::post('/changePassword', [HomeController::class, 'updatePassword'])->name('user.updatePassword');

/*
|--------------------------------------------------------------------------
| Campaigns
|--------------------------------------------------------------------------
*/
    Route::get('/campaigns', [UserCampaignsController::class, 'index'])->name('user.campaigns.index');
    Route::get('/campaigns/choose-location', [UserCampaignsController::class, 'chooseLocation'])->name('user.campaigns.chooseLocation')->withoutMiddleware('campaign.select');
    Route::post('/campaigns/choose-location', [UserCampaignsController::class, 'updateCampaignLocation'])->name('user.campaigns.chooseLocation.update')->withoutMiddleware('campaign.select');
    Route::get('/campaigns/{campaign}', [UserCampaignsController::class, 'show'])->name('user.campaigns.show');
    
    /*
    |--------------------------------------------------------------------------
    | Sponsors
    |--------------------------------------------------------------------------
    */
    Route::get('/campaigns/{campaign}/sponsors', [UserCampaignsController::class, 'sponsors'])->name('user.sponsors.index');
    Route::post('/sponsors', [UserSponsorsController::class, 'store'])->name('user.sponsors.store');
    Route::get('/sponsors/{sponsor}', [UserSponsorsController::class, 'show'])->name('user.sponsors.show');
    Route::get('/sponsors/{sponsor}/edit', [UserSponsorsController::class, 'edit'])->name('user.sponsors.edit');
    Route::patch('/sponsors/{sponsor}', [UserSponsorsController::class, 'update'])->name('user.sponsors.update');
    Route::get('/sponsors/{sponsor}/letterpad/print', [LetterpadPrintController::class, 'print'])->name('user.sponsors.letterpad.print');

    Route::get('/campaign/{campaign}/sponsors/export', [SponsorsExportController::class, 'export'])->name('user.sponsors.export');

});

// TODO: Remove this endpoint once done with bulk import
Route::get('/register-campaigns-to-existing-users', function(){
    $users = \App\Models\User::whereHas('sponsors')->get();

    if(!count($users)) {
        print("No users found!");
        return;
    }

    print("{count($users)} users! <br>");

    $campaigns = \App\Models\Campaign::where('active', 0)->get('id')->pluck('id')->toArray();

    foreach($users as $user) {

        foreach($campaigns as $campaign) {
            if(!\App\Models\UserCampaign::where(['user_id' => $user->id, 'campaign_id' => $campaign])->exists()) {
                print("Attaching {$campaign} to {$user->name} <br>");
                $user->campaigns()->attach($campaign, ['location' => 'India']);
            }
        }
        // $locations = ['India', 'UAE', 'Qatar'];
        // $user->campaigns()->attach(4, ['location' => $locations[array_rand(['India', 'UAE', 'Qatar'])]]);
    }
});