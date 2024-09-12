<?php

use App\Http\Controllers\AudioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\QuarterController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HadithController;


    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');


    Route::apiResource('books', BookController::class);
    Route::apiResource('hadiths', HadithController::class);
    Route::apiResource('centers', CenterController::class);
    Route::resource('quarters', QuarterController::class);

    Route::prefix('books')->group(function () {
        Route::post('{book}/hadiths/attach', [BookController::class, 'attachHadith']);
        Route::post('{book}/hadiths/detach', [BookController::class, 'detachHadith']);
    });

    Route::prefix('centers')->group(function () {
        Route::post('{center}/books/attach', [CenterController::class, 'attachBook']);
        Route::post('{center}/books/detach', [CenterController::class, 'detachBook']);
    });

    Route::post('hadith-hint', [AudioController::class, 'storeHadithHint']);

    Route::post('/audio', [AudioController::class, 'storeAudio']);
    Route::get('/audio/{id}', [AudioController::class, 'getAudio']);


    Route::post('/admin/login', [AuthController::class, 'AdminLogin']);
    Route::post('/student/login', [AuthController::class, 'StudentLogin']);

    Route::post('/admin/register', [AuthController::class, 'adminRegister']);


    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::apiResource('tests', TestController::class);
        Route::post('/student/register', [AuthController::class, 'studentRegister']);

    });
  
    Route::post('/image/upload',  [AudioController::class, 'uploadImage']);
    Route::get('/image/{filename}',  [AudioController::class, 'getImage']);