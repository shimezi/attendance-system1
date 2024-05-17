<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use App\Models\Attendance;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
//use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class RestController extends Controller
{
    //休憩開始の打刻
    public function startRest(Request $request)
    {
        // ユーザーの最新の勤務記録を取得
        $latestAttendance = Attendance::where('user_id', Auth::id())->latest('start_time')->first();
        if (!$latestAttendance) {
            return redirect()->back()->withErrors('勤務開始が記録されていません');
        }

        //休憩開始のロジック
        $rest = new Rest([
            'attendance_id' => $latestAttendance->id,  //適切にattendance_idを取得する必要あり
            'start_time' => CarbonImmutable::now(),
        ]);

        $rest->save();

        return redirect()->back()->with('status', '休憩開始の打刻が完了しました');
    }

    //休憩終了の打刻
    public function endRest(Request $request)
    {
        // ユーザーの最新の休憩記録を取得して終了時間を設定
        $latestRest = Rest::whereHas('attendance', function ($query) {
            $query->where('user_id', Auth::id());
        })->whereNull('end_time')->latest()->first();

        // ユーザーの最新の休憩記録を取得して終了時間を設定
        if ($latestRest) {
            $latestRest->end_time = CarbonImmutable::now();
            $latestRest->save();
            return redirect()->back()->with('status', '休憩終了の打刻が完了しました');
        }

        return redirect()->back()->withErrors('休憩開始が記録されていません');
    }
}
