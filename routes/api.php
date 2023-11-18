<?php

use App\Http\Controllers\PatientController;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
      
});

Route::middleware('auth:sanctum')->group(function (){
    
});

    // route patients dgn method GET & action INDEX
    // action route for get all resource
    Route::get('/patients', [PatientController::class, 'index']);

    // route patients dgn method POST & action STORE
    // action route for add resource
    Route::post('/patients', [PatientController::class, 'store']);

    // menampilkan detail data dengan method GET dan action SHOW
    Route::get('/patients/{id}', [PatientController::class, 'show']);

    // route patients dgn method PUT & action UPDATE
    // action route for edit resource
    Route::put('/patients/{id}', [PatientController::class, 'update']);

    // route patients dgn method DELETE & action DELETE
    // action route for delete resource
    Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

    // route patients dgn method GET & action SEARCH
    // action route for get search resource by name
    Route::get('/patients/search/{name}', [PatientController::class, 'search']);

    // route patients dgn method GET & action POSITIVE
    // action route for get positive resource
    Route::get('/patients/status/positive', [PatientController::class, 'positive']);

    // route patients dgn method GET & action RECOVERED
    // action route for get recovered resource
    Route::get('/patients/status/recovered', [PatientController::class, 'recovered']);

    // route patients dgn method GET & action DEAD
    // action route for get dead resource
    Route::get('/patients/status/dead', [PatientController::class, 'dead']);



   
// Authentikasi register & login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
