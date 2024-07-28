<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceOfStudent extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('AttendaceStudent')->insert([
            [
                'date' => '2024-07-28',
                'is_attend' => true,
                'id_student' => 1,
                'id_subject' => 2
            ],
            [
                'date' => '2024-07-28',
                'is_attend' => false,
                'id_student' => 2,
                'id_subject' => 1
            ],
            [
                'date' => '2024-07-28',
                'is_attend' => true,
                'id_student' => 1,
                'id_subject' => 4
            ],
            [
                'date' => '2024-07-28',
                'is_attend' => false,
                'id_student' => 2,
                'id_subject' => 2,
            ]
        ]);
    }
}
