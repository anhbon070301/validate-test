<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\WardController;

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


Route::get('/district', [DistrictController::class, "index"]);
Route::post('/district/add', [DistrictController::class, "store"]);
Route::post('/district/update/{id}', [DistrictController::class, "update"]);
Route::get('/district/show/{id}', [DistrictController::class, "show"]);
Route::get('/district/destroy/{id}', [DistrictController::class, "destroy"]);

Route::get('/province', [ProvinceController::class, "index"]);
Route::post('/province/add', [ProvinceController::class, "store"]);
Route::post('/province/update/{id}', [ProvinceController::class, "update"]);
Route::get('/province/show/{id}', [ProvinceController::class, "show"]);
Route::get('/province/destroy/{id}', [ProvinceController::class, "destroy"]);

Route::get('/ward', [WardController::class, "index"]);
Route::post('/ward/add', [WardController::class, "store"]);
Route::post('/ward/update/{id}', [WardController::class, "update"]);
Route::get('/ward/show/{id}/{idDistrict}', [WardController::class, "show"]);
Route::get('/ward/destroy/{id}', [WardController::class, "destroy"]);