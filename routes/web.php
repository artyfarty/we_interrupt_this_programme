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

Route::middleware('auth.basic')->group(function () {
    Route::get("queue_entries", [\App\Http\Controllers\QueueController::class, "index"])->name('queue-entries');
    Route::post("queue_entries/toggle/{id}", [\App\Http\Controllers\QueueController::class, "toggle"])->name('queue-entries.toggle');

    Route::resource('notifications', \App\Http\Controllers\NotificationController::class);
    Route::resource('configs', \App\Http\Controllers\ConfigController::class);
    Route::resource('program-events', \App\Http\Controllers\ProgramEventController::class);

    Route::get("donations", [\App\Http\Controllers\DonationsController::class, "index"])->name('donations');
    Route::post("donations/toggle/{id}", [\App\Http\Controllers\DonationsController::class, "toggle"])->name('donations.toggle');
});
