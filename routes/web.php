<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterestTypesController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('get-services', [ServiceController::class, "show"]);
Route::get('get-interests', [InterestTypesController::class, "show"]);
Route::post('add-user', [UsersController::class, "create"]);
// Route::post('send-email', [EmailController::class, "sendEmail"]);
