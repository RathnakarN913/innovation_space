<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController; 

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

Route::post('send-otp', [ApiController::class, 'store']);
Route::post('verify-otp', [ApiController::class, 'verify_otp']);
Route::post('select-project', [ApiController::class, 'select_project'])->name('select_project');
Route::post('update-survey-data', [ApiController::class, 'update_survey_data'])->name('update_survey_data');