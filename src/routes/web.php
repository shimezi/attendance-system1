<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestController;
use Illuminate\Routing\RouteRegistrar;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('dashboard');
    Route::post('/attendance/start_time', [AttendanceController::class, 'start']);
    Route::post('/attendance/end_time', [AttendanceController::class, 'end']);
    Route::post('/rest/start_time', [RestController::class, 'start']);
    Route::post('/rest/end_time', [RestController::class, 'end']);
    Route::get('/attendance', [AttendanceController::class, 'show']);
});
