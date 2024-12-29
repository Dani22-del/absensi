<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\testController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'login'], function () {
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/login/aksi_login', [LoginController::class, 'aksi_login'])->name('aksi_login');
});
Route::middleware(['CheckLogin'])->group(function () {
    Route::get('/', function () {
        return view('sales.main');
    });
    Route::group(['prefix' => 'sales'], function () {
        Route::get('/', [SalesController::class, 'index'])->name('data-sales');
        Route::post('/add-sales', [SalesController::class, 'addSales'])->name('form-add-sales');
        // Route::post('/edit-Principle', [PrincipleController::class, 'editPrinciple'])->name('form-edit-Principle');
        Route::post('/store-sales', [SalesController::class, 'store'])->name('store-sales');
        Route::post('/delete-sales', [SalesController::class, 'destroy'])->name('destroy-sales');
    });
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', [CustomerController::class, 'index'])->name('data-customer');
        Route::post('/add-customer', [CustomerController::class, 'addCustomer'])->name('form-add-customer');
        // Route::post('/edit-Principle', [PrincipleController::class, 'editPrinciple'])->name('form-edit-Principle');
        Route::post('/store-customer', [CustomerController::class, 'store'])->name('store-customer');
        Route::post('/delete-customer', [CustomerController::class, 'destroy'])->name('destroy-customer');
    });
    Route::group(['prefix' => 'schedule'], function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('schedule');
        Route::post('/add-schedule', [ScheduleController::class, 'addSchedule'])->name('form-add-schedule');
        Route::post('/detail-schedule', [ScheduleController::class, 'detailSchedule'])->name('detail-schedule');
        // Route::post('/edit-Principle', [PrincipleController::class, 'editPrinciple'])->name('form-edit-Principle');
        Route::post('/store-schedule', [ScheduleController::class, 'store'])->name('store-schedule');
        Route::post('/delete-schedule', [ScheduleController::class, 'destroy'])->name('destroy-schedule');
    });
    Route::group(['prefix' => 'absensi'], function () {
        Route::get('/', [AbsensiController::class, 'index'])->name('absensi');
        Route::post('/add-absensi', [AbsensiController::class, 'addAbsensi'])->name('form-add-absensi');
        Route::post('/detail-absensi', [AbsensiController::class, 'detailAbsensi'])->name('detail-absensi');
        // Route::post('/edit-Principle', [PrincipleController::class, 'editPrinciple'])->name('form-edit-Principle');
        Route::post('/store-absensi', [AbsensiController::class, 'store'])->name('store-absensi');
        Route::post('/delete-absensi', [AbsensiController::class, 'destroy'])->name('destroy-absensi');
    });
});