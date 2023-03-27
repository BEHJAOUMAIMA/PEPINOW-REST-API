<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PlantsController;
use  App\Http\Controllers\CategoryController;
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


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
//     Route::post('/auth/logout',[AuthController::class,'logout']);
// });
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::put('/updateProfile',[AuthController::class,'updateProfile']);
    Route::get('/allPlants', [PlantsController::class, "index"]);
    Route::get('/plant/{id}', [PlantsController::class, "show"]);
    Route::get('/plants/categories/{id}', [PlantsController::class, 'filterCategory']);
});
Route::middleware(['auth:sanctum','IsAdmin'])->group(function () {
    Route::apiResource('/categories', CategoryController::class);
    Route::get('/plants', [PlantsController::class, "index"]);
    Route::get('/getPlant/{id}', [PlantsController::class, "show"]);
    Route::put('/editPlant/{id}', [PlantsController::class, "update"]);
    Route::delete('/deletePlant/{id}', [PlantsController::class, "destroy"]);
    Route::get('/allUsers',[AuthController::class,'allUsers']);
    Route::put('/changeRole/{id}',[AuthController::class,'changeRole']);
});

Route::middleware(['auth:sanctum','IsSeller'])->group(function () {
    Route::apiResource('/plants', PlantsController::class);
});

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/resetPassword', [AuthController::class, 'resetPassword']);

