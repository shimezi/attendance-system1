<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestController;

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

Route::get('/', [AttendanceController::class, 'index']);
Route::post('/start_time', [AttendanceController::class, 'start_time']);
Route::post('/end_time', [AttendanceController::class, 'end_time']);

Route::post('/start_time', [RestController::class, 'start_time']);
Route::post('/end_time', [RestController::class, 'end_time']);

Route::get('/login', [AuthController::class, 'login']);
