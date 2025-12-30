<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\IVRController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', function () {
    // return view('layouts.app');
    return view('auth.reset-template');
});

Route::get('/',[Controller::class,'getMcqs']);

Route::get('/login',[Controller::class,'login'])->name('login');
Route::get('/register',[Controller::class,'register'])->name('register');
Route::get('/forgot-password',[Controller::class,'forgotPassword'])->name('forgotPassword');
Route::get('/reset-password',[Controller::class,'resetPassword'])->name('resetPassword');
Route::get('/change-password',[Controller::class,'changePassword'])->name('changePassword');


Route::post('/register',[AuthController::class,'registerr'])->name('register.test');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/verify-email', [AuthController::class, 'verifyEmail']);


Route::post('/ivr/entry', [IVRController::class, 'entry']);
Route::post('/ivr/menu', [IVRController::class, 'menu']);
Route::post('/ivr/support', [IVRController::class, 'support']);
Route::post('/ivr/sales', [IVRController::class, 'sales']);
Route::post('/ivr/helpdesk', [IVRController::class, 'helpdesk']);
Route::post('/ivr/agent-connect', [IVRController::class, 'connectAgent']);
Route::post('/ivr/support-action', [IVRController::class, 'supportAction']);
