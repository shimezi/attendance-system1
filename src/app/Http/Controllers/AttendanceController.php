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

    public function startAttendance()
    {
        $today = CarbonImmutable::today();
        $attendance = Attendance::where('user_id', Auth::id())->where('date', $today)->first();

        if (!$attendance) {
            $attendance = new Attendance([
                'user_id' => Auth::id(),
                'date' => $today,
                'start_time' => now(),
            ]);
            $attendance->save();
        }
        return redirect('/')->with('status', 'Attendance started successfully!');
    }

    public function endAttendance()
    {
        $today = CarbonImmutable::today();
        $attendance = Attendance::where('user_id', Auth::id())->where('date', $today)->first();

        if ($attendance && !$attendance->end_time) {
            $attendance->update(['end_time' => CarbonImmutable::now()]);
            return redirect('/')->with('status', 'Attendance ended successfully!');
        }
        return redirect('/')->with('status', 'You cannot end work before starting it');
    }

    public function showAttendance()
    {
        $attendances = Attendance::where('user_id', Auth::id())->get();
        return view('attendance', compact('attendances'));
    }
}
