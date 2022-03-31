<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientsController;
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
// Route::resource('/', PatientsController::class, [
//     'except' => ['edit', 'show', 'store']
// ]);
Route::get('patients', function (Request $request) {
    return Patient::all();
});

Route::get('patients/{id}', function (Request $request, $id) {
    return Patient::find($id);
});