<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Parents')->insert([
            [
                'name' => 'Nguyễn Văn Thoại',
                'date_of_birth' => '1988-07-01',
                'phone_number' => '0906040887',
                'email_address' => 'nguyenvanthoai@gmail.com',
                'address' => 'Quảng Ngãi'
            ],
            [
                'name' => 'Trần Hữu Thành',
                'date_of_birth' => '1992-05-02',
                'phone_number' => '0906040111',
                'email_address' => 'tranhuuthanh@gmail.com',
                'address' => 'Quảng Ninh'
            ],
            [
                'name' => 'Nguyễn Thành Đạt',
                'date_of_birth' => '1997-08-08',
                'phone_number' => '0906040665',
                'email_address' => 'nguyenthanhdat@gmail.com',
                'address' => 'Quảng Bình'
            ],
            [
                'name' => 'Phạm Văn Bình',
                'date_of_birth' => '1989-01-02',
                'phone_number' => '0906040009',
                'email_address' => 'phambinh@gmail.com',
                'address' => 'Thừa Thiên Huế'
            ],
            [
                'name' => 'Phan Bá Đức',
                'date_of_birth' => '1995-03-02',
                'phone_number' => '0906048888',
                'email_address' => 'ducphan@gmail.com',
                'address' => 'Đà Nẵng'
            ]
        ]);

        DB::table('Student')->insert([
            [
                'note' => 'Đang học tôt môn Toán',
                'average_grade' => 8.2,
                'id_parent' => 1,
                'id_user' => 4
            ],
            [
                'note' => 'Đang học tốt môn Tiếng Anh',
                'average_grade' => 8.7,
                'id_parent' => 2,
                'id_user' => 8
            ],
        ]);

        
    }
}
