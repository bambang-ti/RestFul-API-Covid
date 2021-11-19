<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

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

// Mengelompokan Route dan menambahkan autentikasi sanctum
Route::middleware(['auth:sanctum'])->group(function(){
    // Route GET all patients
    Route::get("/patients", [PatientController::class, 'index']);

    // Route POST patients
    Route::post("/patients", [PatientController::class, 'store']);

    // Route GET detail patient
    Route::get("/patients/{id}", [PatientController::class, 'show']); 

    // Route PUT patients
    Route::put("/patients/{id}", [PatientController::class, 'update']);

    // Route DELETE patients
    Route::delete("/patients/{id}", [PatientController::class, 'destroy']);

    // Route search resoure
    Route::get("/patients/search/{name}", [PatientController::class, 'search']);

    // Route status positive
    Route::get("/patients/status/positive", [PatientController::class, 'positive']);

    // Route status recovered
    Route::get("/patients/status/recovered", [PatientController::class, 'recovered']);

    // Route status dead
    Route::get("/patients/status/dead", [PatientController::class, 'dead']);

});


// Register dan login
Route::post("/register", [AuthController::class, 'register']);
Route::post("/login", [AuthController::class, 'login']);

