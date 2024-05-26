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

// 認証が必要なルート
Route::middleware('auth')->group(function () {
    // ホームページ
    Route::get('/', [AttendanceController::class, 'index'])->name('index');

    // 日付別勤務一覧
    Route::get('/attendance', [AttendanceController::class, 'attendance'])->name('attendance');

    // 勤務開始
    Route::post('/attendance/start', [AttendanceController::class, 'startAttendance'])->name('attendance.start');

    // 勤務終了
    Route::post('/attendance/end', [AttendanceController::class, 'endAttendance'])->name('attendance.end');

    // 休憩開始
    Route::post('/rest/start', [RestController::class, 'startRest'])->name('rest.start');

    // 休憩終了
    Route::post('/rest/end', [RestController::class, 'endRest'])->name('rest.end');
});
