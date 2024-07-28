<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Subject')->insert([
            [
                'name' => 'Deleted Subject',
                'amount' => 0,
                'date_begin' => '2024-12-31',
                'total_month' => 3,
                'date_in_week' => 2,
                'time_start' => '00:00:00',
                'time_one_session' => 0,
                'id_teacher' => 1
            ],
            [
                'name' => 'Toán Cao Cấp',
                'amount' => 300000,
                'date_begin' => '2024-07-01',
                'total_month' => 3,
                'date_in_week' => 2,
                'time_start' => '08:00:00',
                'time_one_session' => 2,
                'id_teacher' => 2
            ],
            [
                'name' => 'Tiếng anh giao tiếp',
                'amount' => 400000,
                'date_begin' => '2024-06-01',
                'total_month' => 6,
                'date_in_week' => 3,
                'time_start' => '19:00:00',
                'time_one_session' => 2,
                'id_teacher' => 7
            ],
            [
                'name' => 'TOEIC FOR KIDS',
                'amount' => 800000,
                'date_begin' => '2024-07-01',
                'total_month' => 6,
                'date_in_week' => 3,
                'time_start' => '19:00:00',
                'time_one_session' => 2,
                'id_teacher' => 2
            ],
            [
                'name' => 'Toán Thêm lớp 8',
                'amount' => 300000,
                'date_begin' => '2024-05-01',
                'total_month' => 3,
                'date_in_week' => 6,
                'time_start' => '18:00:00',
                'time_one_session' => 2,
                'id_teacher' => 2
            ],
            [
                'name' => 'Toán Trí Tuệ',
                'amount' => 400000,
                'date_begin' => '2024-07-01',
                'total_month' => 3,
                'date_in_week' => 6,
                'time_start' => '19:00:00',
                'time_one_session' => 2,
                'id_teacher' => 2
            ],
        ]);

        DB::table('StudyFee')->insert([
            [
                'id_subject' => 2,
                'id_student' => 1,
                'id_employee' => 3,
                'date_collect' => '2024-07-02',
            ],
            [
                'id_subject' => 2,
                'id_student' => 2,
                'id_employee' => 6,
                'date_collect' => '2024-07-05',
            ],
            [
                'id_subject' => 4,
                'id_student' => 2,
                'id_employee' => 3,
                'date_collect' => NULL,
            ],
            [
                'id_subject' => 4,
                'id_student' => 1,
                'id_employee' => 6,
                'date_collect' => NULL,
            ],
            [
                'id_subject' => 5,
                'id_student' => 2,
                'id_employee' => 6,
                'date_collect' => NULL,
            ],
            [
                'id_subject' => 3,
                'id_student' => 2,
                'id_employee' => 6,
                'date_collect' => NULL,
            ],
        ]);

        DB::table('Grade')->insert([
            [
                'id_student' => 1,
                'id_subject' => 2,
                'grade' => 8.2,
            ],
            [
                'id_student' => 1,
                'id_subject' => 2,
                'grade' => 8.7,
            ],
            [
                'id_student' => 1,
                'id_subject' => 3,
                'grade' => 8.3,
            ],
            [
                'id_student' => 2,
                'id_subject' => 1,
                'grade' => 7.2,
            ],
            [
                'id_student' => 1,
                'id_subject' => 4,
                'grade' => 8.8,
            ]
        ]);
    }
}
