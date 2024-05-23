<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Carbon\CarbonImmutable;
use CreateAttendancesTable;

use function PHPUnit\Framework\isNull;

class AttendanceController extends Controller
{
    // 打刻ボタンのページ
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $today = CarbonImmutable::today();

            //今日の勤務記録を取得
            $attendance = Attendance::where('user_id', $user->id)->whereDate('date', $today)->first();

            //ボタンの状態を決定
            $canStartAttendance = is_null($attendance);
            $canEndAttendance = $attendance && is_null($attendance->end_time);
            $canStartRest = $attendance && !is_null($attendance->start_time) && is_null($attendance->end_time);
            $canEndRest = $attendance && $attendance->rests()->whereNull('end_time')->exists();
        } else {
            //未認証の場合、全てのボタンを無効にする
            $canStartAttendance = false;
            $canEndAttendance = false;
            $canStartRest = false;
            $canEndRest = false;
        }

        return view('index', compact('canStartAttendance', 'canEndAttendance', 'canStartRest', 'canEndRest'));
    }

    //日付別勤務一覧のページ
    public function attendance()
    {
        $attendances = Attendance::with('user')->get();
        return view('attendance', compact('attendances'));
    }

    // 勤務開始
    public function startAttendance(Request $request)
    {
        $attendance = new Attendance();
        $attendance->user_id = Auth::id();
        $attendance->date = CarbonImmutable::now()->toDateString();
        $attendance->start_time = CarbonImmutable::now();
        $attendance->save();

        return redirect()->route('index')->with('success', '勤務を開始しました');
    }

    // 勤務終了
    public function endAttendance(Request $request)
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('date', CarbonImmutable::now()->toDateString())
            ->latest()
            ->first();
        $attendance->end_time = CarbonImmutable::now();
        $attendance->save();

        return redirect()->route('index')->with('success', '勤務を終了しました');
    }
}
