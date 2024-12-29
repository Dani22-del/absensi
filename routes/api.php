<?php

use App\Http\Controllers\Api\AbsensiApiController;
use App\Http\Controllers\Api\CustomerApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JWTController;
use App\Http\Controllers\API\Jwt1Controller;
use App\Http\Controllers\API\SalesApiController;
use App\Http\Controllers\Api\ScheduleApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [JWTController::class, 'auth']);

Route::middleware('jwt.auth')->group(function() {
    Route::post('/test', [Jwt1Controller::class, 'test']);
    Route::group(['prefix' => 'sales'], function () {
        Route::get('/index-sales',[SalesApiController::class,'index']);
        Route::get('/find-sales/{id}',[SalesApiController::class,'findOne']);
        Route::post('/store-sales',[SalesApiController::class,'store']);
        Route::post('/delete-sales',[SalesApiController::class,'destroy']);
    });
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/index-customer',[CustomerApiController::class,'index']);
        Route::get('/find-customer/{id}',[CustomerApiController::class,'findOne']);
        Route::post('/store-customer',[CustomerApiController::class,'store']);
        Route::post('/delete-customer',[CustomerApiController::class,'destroy']);
    });
    Route::group(['prefix' => 'schedule'], function () {
        Route::get('/index-schedule',[ScheduleApiController::class,'index']);
        Route::get('/find-schedule/{id}',[ScheduleApiController::class,'findOne']);
        Route::post('/store-schedule',[ScheduleApiController::class,'store']);
        Route::post('/delete-schedule',[ScheduleApiController::class,'destroy']);
    });
    Route::group(['prefix' => 'absensi'], function () {
        Route::get('/index-absensi',[AbsensiApiController::class,'index']);
        Route::get('/find-absensi/{id}',[AbsensiApiController::class,'findOne']);
        Route::post('/store-absensi',[AbsensiApiController::class,'store']);
        Route::post('/delete-absensi',[AbsensiApiController::class,'destroy']);
    });
});