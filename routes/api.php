<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;

Route::post('/register',[UserAccountController::class,"register"])->name('app.register');
Route::post('/login',[UserAccountController::class,"login"])->name('app.login');
Route::middleware('auth:sanctum')->group(function(){
    Route::post("/logout", [UserAccountController::class, "logout"])->name('app.logout');
    Route::get("/me",[UserAccountController::class, "me"])->name('app.profile');
});

// Public Access Endpoints

Route::group(['prefix' => 'v1'],function(){
    Route::middleware('throttle:40,1')->get("/getCountries",[CountryController::class, "index"]);
    Route::middleware('throttle:40,1')->get("/getCountryNameByCode", [CountryController::class , "getCountryName"]);
    Route::middleware("throttle:60,1")->get("/getDistricts/{code}",[DistrictController::class , "index"]);
});