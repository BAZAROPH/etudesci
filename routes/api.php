<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login-validation', 'App\Http\Controllers\AuthController@loginValidation');
Route::post('/register-validation', 'App\Http\Controllers\AuthController@registerValidation');

Route::middleware(['auth:sanctum'])->group(function(){

    //Following a course
    Route::post('/get-course', 'App\Http\Controllers\CourseController@APIgetCourse');
    Route::post('/get-module', 'App\Http\Controllers\CourseController@APIgetModule');
    Route::post('/update-module-state-finish', 'App\Http\Controllers\CourseController@APIupdateModuleStateFinish');
    Route::post('/update-module-state-unfinish', 'App\Http\Controllers\CourseController@APIupdateModuleStateUnFinish');


    //Resumes
    Route::post('/moncv/create', 'App\Http\Controllers\ResumeController@create');
    Route::get('/moncv/get', 'App\Http\Controllers\ResumeController@get');

    //Subscriptions
    Route::post('/subscriptions/payment/preprocess', 'App\Http\Controllers\SubscriptionController@preprocess');

    //Payments
    Route::post('/payment/preprocess', 'App\Http\Controllers\PaymentController@paid');

});
