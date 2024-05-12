<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Carbon\CarbonImmutable;
use CreateAttendancesTable;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function start(Request $request)
    {
        $attendance = new Attendance();
        $attendance->user_id = Auth::id();
        $attendance->date = CarbonImmutable::today();
        $attendance->start_time = CarbonImmutable::now();
        $attendance->save();

        return redirect('/');
    }

    public function end(Request $request)
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('date', CarbonImmutable::today())
            ->first();

        if ($attendance) {
            $attendance->end_time = CarbonImmutable::now();
            $attendance->save();
        }

        return redirect('/');
    }

    public function show()
    {
        // ログインユーザーの出勤データを取得
        $attendances = Attendance::with(['user', 'rests'])
            ->where('user_id', Auth::id())
            ->get();

        // データをビューに渡す
        return view('attendance', compact('attendances'));
    }
}
