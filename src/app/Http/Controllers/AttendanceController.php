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
        //indexビューを呼び出す際に特定のデータは不要な場合、単にビューを渡す
        return view('index');
    }

    public function showAttendance()
    {
        //日付指定がある場合はその日付で、なければ今日の日付でデータを取得
        $date = request('date') ? CarbonImmutable::createFromFormat('Y-m-d', request('date')) : CarbonImmutable::today();
        $attendances = Attendance::with(['user', 'rests'])->whereDate('date', $date->format('Y-m-d'))->paginate(5);
        return view('attendance', compact('attendances', 'date'));
    }

    //勤務開始の打刻
    public function startAttendance()
    {
        $attendance = new Attendance([
            'user_id' => Auth::id(),
            'date' => CarbonImmutable::today()->format('Y-m-d'),
            'start_time' => CarbonImmutable::now(),
        ]);
        $attendance->save();

        return redirect()->route('index')->with('status', '勤務開始の打刻が完了しました');
    }

    //勤務終了の打刻
    public function endAttendance(Request $request)
    {
        //勤務終了のロジックを実装
        //例：最後の勤務開始記録を検索し終了時間を設定
        $attendance = Attendance::where('user_id', Auth::id())->latest('start_time')->first();
        if ($attendance) {
            $attendance->end_time = CarbonImmutable::now();
            $attendance->save();
        }

        return redirect()->route('index')->with('status', '勤務終了の打刻が完了しました');
    }

    public function showAttendances()
    {
        $date = request('date') ? CarbonImmutable::createFromFormat('Y-m-d', request('date')) : CarbonImmutable::today();
        // ページネーションの適用
        $attendances = Attendance::where('user_id', Auth::id())
            ->whereDate('date', $date->format('Y-m-d'))
            ->paginate(5); // 1ページあたりのアイテム数を指定

        return view('attendance', compact('attendances', 'date'));
    }
}
