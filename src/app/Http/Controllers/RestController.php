<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class RestController extends Controller
{
    public function startRest()
    {
        $attendance = Attendance::where('user_id', Auth::id())->latest('date')->first();

        if ($attendance && !$attendance->rests()->whereNull('end_time')->exists()) {
            Rest::create([
                'attendance_id' => $attendance->id,
                'start_time' => now(),
            ]);
            return redirect('/')->with('status', 'Rest started successfully!');
        }
        return redirect('/')->with('status', 'You must finish the current rest to start a new one.');
    }

    public function endRest()
    {
        $attendance = Attendance::where('user_id', Auth::id())->latest()->first();
        $rest = $attendance ? $attendance->rests()->whereNull('end_time')->first() : null;

        if ($rest) {
            $rest->update(['end_time' => now()]);
            return redirect('/')->with('status', 'Rest ended successfully!');
        }
        return redirect('/')->with('status', 'No ongoing rest to end.');
    }
}
