<?php

use App\Http\Controllers\api\CampaignStatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/campaigns/stats/batchWise/notReceived', [CampaignStatsController::class, 'batchWiseNotReceived']);
Route::get('/campaigns/stats/batchWise', [CampaignStatsController::class, 'batchWiseTotalAmount']);
Route::get('/campaigns/stats/toppers', [CampaignStatsController::class, 'toppers']);
Route::get('/campaigns/stats/target', [CampaignStatsController::class, 'target']);
