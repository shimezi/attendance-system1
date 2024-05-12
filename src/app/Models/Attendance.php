<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonImmutable;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rests()
    {
        return $this->hasMany(Rest::class);
    }

    public function getRestDurationAttribute()
    {
        $rests = $this->rests;
        $totalDuration = 0;

        foreach ($rests as $rest) {
            if ($rest->start_time && $rest->end_time) {
                $start = CarbonImmutable::createFromFormat('H:i:s', $rest->start_time);
                $end = CarbonImmutable::createFromFormat('H:i:s', $rest->end_time);
                $totalDuration += $end->diffInSeconds($start);
            }
        }

        return gmdate('H:i:s', $totalDuration);
    }

    public function getWorkDurationAttribute()
    {
        if ($this->start_time && $this->end_time) {
            $start = CarbonImmutable::createFromFormat('H:i:s', $this->start_time);
            $end = CarbonImmutable::createFromFormat('H:i:s', $this->end_time);
            $workDuration = $end->diffInSeconds($start) - $this->getRestDurationInSecondsAttribute();
            return gmdate('H:i:s', $workDuration);
        }

        return null;
    }

    public function getRestDurationInSecondsAttribute()
    {
        $rests = $this->rests;
        $totalDuration = 0;

        foreach ($rests as $rest) {
            if ($rest->start_time && $rest->end_time) {
                $start = CarbonImmutable::createFromFormat('H:i:s', $rest->start_time);
                $end = CarbonImmutable::createFromFormat('H:i:s', $rest->end_time);
                $totalDuration += $end->diffInSeconds($start);
            }
        }

        return $totalDuration;
    }
}
