<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use App\Models\Attendance;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;

class RestController extends Controller
{
    public function start(Request $request)
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('date', CarbonImmutable::today())
            ->first();

        if ($attendance) {
            $rest = new Rest();
            $rest->attendance_id = $attendance->id;
            $rest->start_time = CarbonImmutable::now();
            $rest->save();
        }

        return redirect('/');
    }

    public function end(Request $request)
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('date', CarbonImmutable::today())
            ->first();

        if ($attendance) {
            $rest = Rest::where('attendance_id', $attendance->id)
                ->whereNull('end_time')
                ->first();

            if ($rest) {
                $rest->end_time = CarbonImmutable::now();
                $rest->save();
            }
        }

        return redirect('/');
    }
}
