<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\CarbonImmutable;

class AttendanceController extends Controller
{
    // 打刻ボタンのページ
    public function index()
    {
        $user = Auth::user();
        $today = CarbonImmutable::today();
        $yesterday = $today->subDay();

        // 今日の勤務記録を取得
        $attendance = Attendance::where('user_id', $user->id)->whereDate('date', $today)->first();

        // ボタンの状態を決定
        $canStartAttendance = is_null($attendance);
        $canEndAttendance = false;
        $canStartRest = false;
        $canEndRest = false;

        if ($attendance) {
            // 勤務終了後はすべてのボタンを無効にする
            if ($attendance && $attendance->end_time) {
                $canStartAttendance = false;
                $canEndAttendance = false;
                $canStartRest = false;
                $canEndRest = false;
            } else {
                // 休憩開始後は休憩開始ボタンを無効にし、休憩終了ボタンを有効にする
                $rest = $attendance->rests()->latest()->first();
                if ($rest && is_null($rest->end_time)) {
                    $canStartRest = false;
                    $canEndRest = true;
                } else {
                    $canStartRest = true;
                    $canEndRest = false;
                }

                $canEndAttendance = !$attendance->rests()->whereNull('end_time')->exists();
            }
        }

        return view('index', compact('canStartAttendance', 'canEndAttendance', 'canStartRest', 'canEndRest'));
    }

    // 日付別勤務一覧のページ
    public function attendance(Request $request)
    {
        // リクエストから日付を取得し、存在しない場合は今日の日付を使用
        $date = $request->input('date', CarbonImmutable::now()->toDateString());
        $date = CarbonImmutable::parse($date);

        // その日の勤務記録を取得
        $attendances = Attendance::with('user')->whereDate('date', $date)->paginate(5);

        return view('attendance', [
            'attendances' => $attendances,
            'date' => $date->toDateString(),
            'previousDate' => $date->subDay()->toDateString(),
            'nextDate' => $date->addDay()->toDateString()
        ]);
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
