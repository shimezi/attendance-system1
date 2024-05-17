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
}
