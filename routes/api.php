<?php

use App\Http\Controllers\Api\PartnershipController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LokasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('lokasi', [LokasiController::class, 'retrieve']);
Route::get('home', [UserController::class, 'home']);
Route::get('payment-link', [UserController::class, 'paymentLink']);
Route::get('info/{id}', [InfoController::class, 'read']);

Route::group(['prefix' => "user"], function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
    Route::post('update', [UserController::class, 'update']);
    Route::post('auth', [UserController::class, 'auth']);
    Route::post('submit-wa', [UserController::class, 'submitWa']);
    Route::post('logout', [UserController::class, 'logout']);
});

Route::group(['prefix' => "partnership"], function () {
    Route::get('{type}/form', [PartnershipController::class, 'form']);
    Route::post('{type}', [PartnershipController::class, 'submit']);
});