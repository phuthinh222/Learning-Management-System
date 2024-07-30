<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attendances')->insert([
            [
                'date' => '2024-07-21',
                'time_check_in' => '08:00:00',
                'time_check_out' => '17:00:00'
            ],
            [
                'date' => '2024-07-22',
                'time_check_in' => '08:00:00',
                'time_check_out' => '17:00:00'
            ],
            [
                'date' => '2024-07-23',
                'time_check_in' => '08:00:00',
                'time_check_out' => '17:00:00'
            ],
            [
                'date' => '2024-07-24',
                'time_check_in' => '08:00:00',
                'time_check_out' => '17:00:00'
            ],
        ]);

        DB::table('attendance_teachers')->insert([
            [
                'id_teacher' => 2,
                'id_attendance' => 1,
            ],
            [
                'id_teacher' => 7,
                'id_attendance' => 3
            ]
        ]);
    }
}
