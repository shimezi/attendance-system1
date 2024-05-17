<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestController;
use Illuminate\Auth\Events\Attempting;
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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('index');
    route::post('/attendance/start_work', [AttendanceController::class, 'startAttendance'])->name('attendance.start');
    //勤務終了の打刻を行うルート
    Route::post('attendance/end', [AttendanceController::class, 'endAttendance'])->name('attendance.end');
    //休憩開始の打刻を行うルート
    Route::post('/rest/start', [RestController::class, 'startRest'])->name('rest.start');
    //休憩終了の打刻を行うルート
    Route::post('rest/end', [RestController::class, 'endRest'])->name('rest.end');
});
