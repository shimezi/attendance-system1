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
    // 休憩開始
    public function startRest(Request $request)
    {
        // 勤務が開始されているか確認
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('date', CarbonImmutable::now()->toDateString())
            ->latest()
            ->first();

        if ($attendance) {
            $rest = new Rest();
            $rest->attendance_id = $attendance->id;
            $rest->start_time = CarbonImmutable::now();
            $rest->save();

            return redirect()->route('index')->with('success', '休憩を開始しました');
        } else {
            return redirect()->route('index')->with('error', '勤務が開始されていません');
        }
    }

    // 休憩終了
    public function endRest(Request $request)
    {
        // 最新の休憩記録を取得
        $rest = Rest::whereHas('attendance', function ($query) {
            $query->where('user_id', Auth::id())
                ->whereDate('date', CarbonImmutable::now()->toDateString());
        })->latest()->first();

        if ($rest && $rest->end_time === null) {
            $rest->end_time = CarbonImmutable::now();
            $rest->save();

            return redirect()->route('index')->with('success', '休憩を終了しました');
        } else {
            return redirect()->route('index')->with('error', '休憩が開始されていません');
        }
    }
}
