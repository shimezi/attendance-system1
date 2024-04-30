<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            $this->createAttendance($user, '勤務開始', now()->subDays(2)->setTime(9, 0));
            $this->createAttendance($user, '勤務終了', now()->subDays(2)->setTime(18, 0));

            $this->createAttendance($user, '勤務開始', now()->subDays(1)->setTime(9, 30));
            $this->createAttendance($user, '勤務終了', now()->subDays(1)->setTime(18, 30));

            $this->createAttendance($user, '勤務開始', now()->setTime(9, 15));
            $this->createAttendance($user, '勤務終了', now()->setTime(18, 15));
        }
    }

    private function createAttendance($user, $status, $time)
    {
        Attendance::create([
            'user_id' => $user->id,
            'status' => $status,
            'time' => $time,
        ]);
    }
}
