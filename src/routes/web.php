<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestController;
use Illuminate\Routing\RouteRegistrar;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('home');
    Route::get('/attendance', [AttendanceController::class, 'showAttendance'])->name('attendance.show');
    Route::post('/attendance/start', [AttendanceController::class, 'startAttendance'])->name('attendance.start');
    Route::post('/attendance/end', [AttendanceController::class, 'endAttendance'])->name('attendance.end');
    Route::post('/rest/start', [RestController::class, 'startRest'])->name('rest.start');
    Route::post('/rest/end', [RestController::class, 'endRest'])->name('rest.end');
});
