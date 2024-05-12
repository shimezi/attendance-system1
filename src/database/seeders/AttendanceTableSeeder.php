<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < ; $i++) { 
            $date = Carbon::now()->subDays(rand(1,30));
            $startTime = $date->copy()->setHour(rand(8,10))->setMinute(rand0,59);
            $endTime = $date->copy()->setHour(rand(17,19))->setMinute(rand(0,59));

            DB::table('attendance')->insert([
                'user_id'=> $i,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'create_at' => Carbon::now(),
                'update_at' => Carbon::now(),
            ]);
        }
    }

}
