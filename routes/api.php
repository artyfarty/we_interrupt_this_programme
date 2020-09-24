<?php

use App\Http\Controllers\NotificationsController;
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

Route::get("poll/{password}", [\App\Http\Controllers\ApiController::class, "poll"]);
Route::get("poll/{password}/{auto_ack}", [\App\Http\Controllers\ApiController::class, "poll"]);
Route::get("ack/{id}/{password}", [\App\Http\Controllers\ApiController::class, "ack"]);
