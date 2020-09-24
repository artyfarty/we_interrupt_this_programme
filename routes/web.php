<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::resource("queue_entries", \App\Http\Controllers\QueueController::class);
Route::resource('notifications', \App\Http\Controllers\NotificationController::class);
Route::resource('configs', \App\Http\Controllers\ConfigController::class);
Route::resource('program-events', \App\Http\Controllers\ProgramEventController::class);
