<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function attendance()
    {
        return view('attendance');
    }

    public function start_time()
    {
        $user = user();

        /**
         * 打刻は1日一回までにしたい 
         * DB
         */
        $oldAttendance = Attendance::where('email', email)->latest()->first();
        if (oldTAttendance) {
            $oldAttendanceStart_Time = new Carbon($oldAttendance->start_time);
            $oldAttendanceDay = $oldAttendanceStart_Time->startOfDay();
        }
        $newAttendanceDay = Carbon::today();
    }
}
