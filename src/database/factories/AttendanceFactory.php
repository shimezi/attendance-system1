<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Attendance;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition()
    {
        $startTime = CarbonImmutable::create(2024, 5, 25)->addDays($this->faker->numberBetween(0, 2))->setTime(9, 0);
        $end_time = (clone $startTime)->addHours(8);
        return [
            'user_id' => User::factory(),
            'date' => $startTime->toDateString(),
            'start_time' => $startTime->toTimeString(),
            'end_time' => $end_time->toTimeString(),
        ];
    }
}
