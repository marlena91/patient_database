<?php

use App\Http\Controllers\Api\DiseasesController;
use App\Http\Controllers\Api\DiseasesPatientsController;
use App\Http\Controllers\Api\MedicalNotesController;
use App\Http\Controllers\Api\MedicalNotesForPatientController;
use App\Http\Controllers\Api\PatientsController;
use App\Http\Controllers\Api\SearchController;
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




Route::resource('patients', PatientsController::class, [
    'except' => ['create']
]);
Route::resource('diseases', DiseasesController::class, [
    'except' => ['create', 'edit']
]);
Route::resource('medical-notes', MedicalNotesController::class, [
    'except' => ['create', 'edit']
]);

Route::get('search', SearchController::class)->name('search');
Route::get('medical-note-patient/{patientID}', MedicalNotesForPatientController::class)->name('med-note-patient.search');


Route::post('/diseases-patients/{diseaseId}/{patientID}', [DiseasesPatientsController::class, 'store'])
    ->name('disease-patient.create');
Route::delete('/diseases-patients/{diseaseId}/{patientID}', [DiseasesPatientsController::class, 'destroy'])
    ->name('disease-patient.destroy');
