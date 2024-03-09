<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthAPIController;
use App\Http\Controllers\API\V1\MedicationAPIController;
use App\Http\Controllers\API\V1\CustomerAPIController;

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

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {

        Route::middleware('auth:sanctum')->group(function () {
            Route::get('current/', [AuthAPIController::class, 'getCurrentUser']);
            Route::post('logout/', [AuthAPIController::class, 'logout']);
        });

        Route::post('login', [AuthAPIController::class, 'login']);

    });

    Route::prefix('medications')->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/', [MedicationAPIController::class, 'index']);
            Route::middleware('check-role')->group(function () {
                Route::post('/', [MedicationAPIController::class, 'store']);
                Route::put('/{id}', [MedicationAPIController::class, 'update']);
                Route::delete('/{id}', [MedicationAPIController::class, 'destroy']);
            });
        });
    });

    Route::prefix('customers')->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/', [CustomerAPIController::class, 'index']);
            Route::middleware('check-role')->group(function () {
                Route::post('/', [CustomerAPIController::class, 'store']);
                Route::put('/{id}', [CustomerAPIController::class, 'update']);
                Route::delete('/{id}', [CustomerAPIController::class, 'destroy']);
            });
        });
    });
});
