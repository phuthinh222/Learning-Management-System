<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('TimeLine')->insert([
            [
                'job_to_do' => 'Hoàn thành việc thanh toán lương cho toàn bộ giáo viên trong trung tâm',
                'date_start' => '2024-07-01',
                'date_end' => '2024-07-31',
                'result_must_reach' => '100% đã thanh toán lương',
                'is_monthly' => true,
                'id_employee' => 6
            ],
            [
                'job_to_do' => 'Hoàn thành chương trình học cho học sinh trong tuần',
                'date_start' => '2024-07-06',
                'date_end' => '2024-07-12',
                'result_must_reach' => '100% đã hoàn thành chương trình học',
                'is_weekly' => true,
                'id_employee' => 7
            ],
        ]);

        DB::table('Marketing')->insert([
            [
                'title' => 'Tin tức mới về chương trình học mới',
                'content' => 'Đây là tin tức mới về chương trình học mới của trung tâm. Bạn có thể đăng ký nhận thông tin từ trung tâm để cập nhật thông tin mới nhất.',
                'date_post' => '2024-07-15',
                'id_employee' => 5
            ],
            [
                'title' => 'Tin tức về chương trình khuyến mãi mới',
                'content' => 'Đây là tin tức mới về chương trình khuyến mãi của trung tâm. Bạn có thể đăng ký nhận thông tin từ trung tâm để cập nhật thông tin mới nhất.',
                'date_post' => '2024-07-16',
                'id_employee' => 5
            ]
        ]);
    }
}
