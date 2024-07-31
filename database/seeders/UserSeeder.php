<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'user_name' => 'admin',
                'password' => Hash::make('admin'),
                'name' => 'Khuyen Pham',
                'email_address' => 'admin@localhost.com',
                'date_of_birth' => '2001-01-05',
                'address' => '76 Vu Lap Street',
                'phone_number' => '0336482917',
                'id_salary_recipe' => 2
            ],
            [
                'user_name' => 'tlvd009.teacher',
                'password' => Hash::make('teacher'),
                'name' => 'Trần Lê Viết Đạt',
                'email_address' => 'tlvd@localhost.com',
                'date_of_birth' => '1995-05-05',
                'address' => 'Thua Thien Hue',
                'phone_number' => '0906040202',
                'id_salary_recipe' => 3 
            ],
            [
                'user_name' => 'dophuthinh.financi',
                'password' => Hash::make('employee'),
                'name' => 'Đỗ Phú Thịnh',
                'email_address' => 'dpt@localhost.com',
                'date_of_birth' => '2002-02-02',
                'address' => 'Thua Thien Hue',
                'phone_number' => '0906040334',
                'id_salary_recipe' => 4 
            ],
            [
                'user_name' => 'phanngockhai.student',
                'password' => Hash::make('student'),
                'name' => 'Phan Ngọc Khải',
                'email_address' => 'pnk@localhost.com',
                'date_of_birth' => '2012-02-02',
                'address' => 'Thua Thien Hue',
                'phone_number' => '0906222334',
                'id_salary_recipe' => 1  
            ],
            [
                'user_name' => 'dinhduoc.marketing',
                'password' => Hash::make('employee'),
                'name' => 'Trần Đình Được',
                'email_address' => 'tdd@localhost.com',
                'date_of_birth' => '2001-02-02',
                'address' => 'Thua Thien Hue',
                'phone_number' => '0906999777',
                'id_salary_recipe' => 4
            ],
            [
                'user_name' => 'binhdinh.financi',
                'password' => Hash::make('employee'),
                'name' => 'Nguyễn Bình Định',
                'email_address' => 'nbd@localhost.com',
                'date_of_birth' => '2003-05-01',
                'address' => 'Quảng Ngãi',
                'phone_number' => '0906040887',
                'id_salary_recipe' => 4 
            ],
            [
                'user_name' => 'tranngoc.teacher',
                'password' => Hash::make('employee'),
                'name' => 'Nguyễn Bình Định',
                'email_address' => 'trngoc@localhost.com',
                'date_of_birth' => '2003-05-01',
                'address' => 'Quảng Ngãi',
                'phone_number' => '0906040654',
                'id_salary_recipe' => 3 
            ],
            [
                'user_name' => 'phanthithuha.student',
                'password' => Hash::make('student'),
                'name' => 'Phan Thị Thu Hà',
                'email_address' => 'thuhaphanlop92@localhost.com',
                'date_of_birth' => '2019-04-07',
                'address' => 'Thừa Thiên Huế',
                'phone_number' => '0396603842',
                'id_salary_recipe' => 1 
            ],
        ]);

        
    }
}
