<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'start_time', 'end_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rests()
    {
        return $this->hasMany(Rest::class);
    }

    public function getTotalRestTimeAttribute()

    {
        $totalRestTime = $this->rests->reduce(function ($carry, $rest) {
            if ($rest->end_time) {
                $start = CarbonImmutable::parse($rest->start_time);
                $end = CarbonImmutable::parse($rest->end_time);
                return $carry + $end->diffInSeconds($start);
            }
            return $carry;
        }, 0);

        return gmdate('H:i:s', $totalRestTime);
    }

    public function getTotalAttendanceTimeAttribute()
    {
        if ($this->end_time) {
            $attendanceTime = CarbonImmutable::parse($this->end_time)->diffInSeconds(CarbonImmutable::parse($this->start_time));
            $totalRestTime = $this->rests->sum(function ($rest) {
                if ($rest->end_time) {
                    $start = CarbonImmutable::parse($rest->start_time);
                    $end = CarbonImmutable::parse($rest->end_time);
                    return $end->diffInSeconds($start);
                }
                return 0;
            });
            $totalAttendanceTime = $attendanceTime - $totalRestTime;
            return gmdate('H:i:s', $totalAttendanceTime);
        }
        return '00:00:00';
    }
}
