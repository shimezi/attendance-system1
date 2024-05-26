<?php

namespace Database\Factories;

use App\Models\Rest;
use App\Models\Attendance;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestFactory extends Factory
{
    protected $model = Rest::class;

    public function definition()
    {
        $startTime = CarbonImmutable::create(2024, 5, 25)->addDays($this->faker->numberBetween(0, 2))->setTime(12, 0);
        $endTime = (clone $startTime)->addMinutes(30);
        return [
            'attendance_id' => Attendance::factory(),
            'start_time' => $startTime->toTimeString(),
            'end_time' => $endTime->toTimeString(),
        ];
    }
}
