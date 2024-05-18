<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonImmutable;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'start_time', 'end_time'];

    protected $date = ['date', 'start_time', 'end_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rests()
    {
        return $this->hasMany(Rest::class);
    }

    //勤務時間を計算します
    public function totalWorkTime()
    {
        if ($this->start_time && $this->end_time) {
            $start = CarbonImmutable::createFromFormat('Y-m-d H;i;s', $this->start_time);
            $end = CarbonImmutable::createFromFormat('Y-m-d H:i:s', $this->end_time);
            return $end->diffInHours($start, false) . 'hours'; // 勤務時間を時間で返します
        }
        return 'Not available'; // 勤務時間が計算できない場合
    }
}
