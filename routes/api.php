<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientsController;
use App\Http\Controllers\Api\DiseasesController;
use App\Http\Controllers\Api\MedicalNotesController;
use App\Http\Controllers\SearchController;
use App\Models\Patient;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('patients', [PatientsController::class, 'index']);
// Route::get('patients/{id}', [PatientsController::class, 'show']);

Route::resource('patients', PatientsController::class);

Route::resource('diseases', DiseasesController::class, [
    'only' => ['index', 'show']
]);

Route::resource('medical-notes', MedicalNotesController::class, [
    'only' => ['index', 'show']
]);

Route::get('patients/search', SearchController::class)->name('patients.search');