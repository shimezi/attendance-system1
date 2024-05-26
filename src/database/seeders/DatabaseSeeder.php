<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Rest;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // ユーザーを15人生成
        User::factory(15)->create()->each(function ($user) {
            // 各ユーザーに対して、2024年5月25日から5月27日の勤務記録を生成
            foreach (range(25, 27) as $day) {
                $attendance = Attendance::factory()->create([
                    'user_id' => $user->id,
                    'date' => "2024-05-$day",
                ]);

                // 各勤務記録に対して、休憩記録を生成
                Rest::factory(2)->create([
                    'attendance_id' => $attendance->id,
                ]);
            }
        });
    }
}
