<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\create_client_controller;
use App\Http\Controllers\project_creation_controller;
use App\Http\Controllers\surveyorcreationcontroller;
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

 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/create_client', [create_client_controller::class, 'create_client'])->middleware(['auth'])->name('create_client');
Route::post('/store_client', [create_client_controller::class, 'store_client'])->middleware(['auth']);
Route::post('/client_update', [create_client_controller::class, 'client_update'])->middleware(['auth']);
Route::get('/client__view/{id}', [create_client_controller::class, 'client__view'])->middleware(['auth']);
Route::get('/client_delete/{id}', [create_client_controller::class, 'client_delete'])->middleware(['auth']);
Route::post('/country_ajax', [create_client_controller::class, 'country_ajax'])->middleware(['auth']);


Route::get('/project_creation', [project_creation_controller::class,'project_creation'])->middleware(['auth']);
Route::post('/project_insert',[project_creation_controller::class,'project_insert'])->middleware(['auth']);
Route::get('/project_edit/{id}',[project_creation_controller::class,'project_edit'])->middleware(['auth']);
Route::post('/project_update',[project_creation_controller::class,'project_update'])->middleware(['auth']);
Route::get('/project_delete/{id}',[project_creation_controller::class,'project_delete'])->middleware(['auth']);


Route::get('/surveyor',[surveyorcreationcontroller::class,'surveyor'])->middleware(['auth']);
Route::post('/insert_serveyor',[surveyorcreationcontroller::class,'insert_serveyor'])->middleware(['auth']);
Route::post('/surveyor',[surveyorcreationcontroller::class,'changestate'])->middleware(['auth']);
Route::get('/surveyoredit/{id}',[surveyorcreationcontroller::class,'surveyoredit'])->middleware(['auth']);
Route::get('/surveyordelete/{id}',[surveyorcreationcontroller::class,'surveyordelete'])->middleware(['auth']);
Route::post('updatesurveyor',[surveyorcreationcontroller::class,'updatesurveyor'])->middleware(['auth']);


Route::get('/mappingsurveyor',[surveyorcreationcontroller::class,'mappingsurveyor'])->middleware(['auth']);
Route::post('/mappingsurveyor_insert',[surveyorcreationcontroller::class,'mappingsurveyor_insert'])->middleware(['auth']);
Route::post('/mapping_surveyor',[surveyorcreationcontroller::class,'changeproject'])->middleware(['auth']);


Route::get('/surveyor/reports',[surveyorcreationcontroller::class,'surveyor_reports'])->middleware(['auth']);
Route::post('/surveyor/reports/filter',[surveyorcreationcontroller::class,'surveyor_reports_filters'])->middleware(['auth']);
Route::get('surveyed-records-details/{id}', [surveyorcreationcontroller::class, 'surveyed_records_details'])->name('surveyed_records_details');

require __DIR__.'/auth.php';