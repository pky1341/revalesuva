<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\User\AuthController;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\API\TechnicalSupportController;
use App\Http\Controllers\API\ServiceInquiryController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('update', [UserController::class, 'update'])->name('user.update');
            Route::get('get-user', [UserController::class, 'getUser'])->name('user.get');
            Route::post('logout', [AuthController::class, 'logout'])->name('user.logout');
            Route::post('check-username', [UserController::class, 'checkUsername']);
        });
        Route::post('technical-support', [TechnicalSupportController::class, 'technicalSupport']);
        Route::post('service-inquiry', [ServiceInquiryController::class, 'inquirySercvice']);
    });
});
