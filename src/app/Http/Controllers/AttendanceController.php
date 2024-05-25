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
            $yesterday = $today->subDay();

            // 前日の未終了の勤務記録をチェックして処理する
            while ($yesterday->lessThan($today)) {
                $attendanceYesterday = Attendance::where('user_id', $user->id)
                    ->whereDate('date', $yesterday->toDateString())
                    ->whereNull('end_time')
                    ->first();

                if ($attendanceYesterday) {
                    $attendanceYesterday->end_time = $yesterday->endOfDay();
                    $attendanceYesterday->save();
                }

                $yesterday = $yesterday->addDay();
            }

            //今日の勤務記録を取得
            $attendance = Attendance::where('user_id', $user->id)->whereDate('date', $today)->first();

            //ボタンの状態を決定
            $canStartAttendance = is_null($attendance);
            $canEndAttendance = $attendance && is_null($attendance->end_time);
            $canStartRest = $attendance && !is_null($attendance->start_time) && is_null($attendance->end_time);
            $canEndRest = $attendance && $attendance->rests()->whereNull('end_time')->exists();

            // 勤務終了後はすべてのボタンを無効にする
            if ($attendance && $attendance->end_time) {
                $canStartAttendance = false;
                $canEndAttendance = false;
                $canStartRest = false;
                $canEndRest = false;
            } else if ($attendance) {
                // 休憩開始後は休憩開始ボタンを無効にし、休憩終了ボタンを有効にする
                $rest = $attendance->rests()->latest()->first();
                if ($rest && is_null($rest->end_time)) {
                    $canStartRest = false;
                    $canEndRest = true;
                } else {
                    $canStartRest = true;
                    $canEndRest = false;
                }
            }
        } else {
            //未認証の場合、全てのボタンを無効にする
            $canStartAttendance = true;
            $canEndAttendance = false;
            $canStartRest = false;
            $canEndRest = false;
        }

        return view('index', compact('canStartAttendance', 'canEndAttendance', 'canStartRest', 'canEndRest'));
    }

    public function attendance(Request $request)
    {
        // リクエストから日付を取得し、存在しない場合は今日の日付を使用
        $date = $request->input('date', CarbonImmutable::now()->toDateString());
        $date = CarbonImmutable::parse($date);

        // その日の勤務記録を取得
        $attendances = Attendance::with('user')->whereDate('date', $date)->get();

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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('date', CarbonImmutable::now()->toDateString())
            ->latest()
            ->first();
        $attendance->end_time = CarbonImmutable::now();
        $attendance->save();

        Auth::logout();
        return redirect()->route('index')->with('success', '勤務を終了しました');
    }
}
