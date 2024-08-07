<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
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
        User::create([
            'user_name' => 'admin',
            'password' => Hash::make('admin'),
            'name' => 'Khuyen Pham',
            'email_address' => 'admin@localhost.com',
            'date_of_birth' => '2001-01-05',
            'address' => '76 Vu Lap Street',
            'phone_number' => '0336482917',
            'id_salary_recipe' => 2,
        ])->assignRole('Admin');

        User::create([
            'user_name' => 'tlvd009',
            'password' => Hash::make('teacher'),
            'name' => 'Trần Lê Viết Đạt',
            'email_address' => 'tlvd@localhost.com',
            'date_of_birth' => '1995-05-05',
            'address' => 'Thua Thien Hue',
            'phone_number' => '0906040202',
            'id_salary_recipe' => 3
        ])->assignRole('Teacher');

        User::create([
            'user_name' => 'dophuthinh',
            'password' => Hash::make('employee'),
            'name' => 'Đỗ Phú Thịnh',
            'email_address' => 'dpt@localhost.com',
            'date_of_birth' => '2002-02-02',
            'address' => 'Thua Thien Hue',
            'phone_number' => '0906040334',
            'id_salary_recipe' => 4
        ])->assignRole('Teacher');

        User::create([
            'user_name' => 'phanngockhai',
            'password' => Hash::make('student'),
            'name' => 'Phan Ngọc Khải',
            'email_address' => 'pnk@localhost.com',
            'date_of_birth' => '2012-02-02',
            'address' => 'Thua Thien Hue',
            'phone_number' => '0906222334',
            'id_salary_recipe' => 1
        ])->assignRole('Student');

        User::create([
            'user_name' => 'tranngoc.teacher',
            'password' => Hash::make('employee'),
            'name' => 'Nguyễn Bình Định',
            'email_address' => 'trngoc@localhost.com',
            'date_of_birth' => '2003-05-01',
            'address' => 'Quảng Ngãi',
            'phone_number' => '0906040654',
            'id_salary_recipe' => 3
        ])->assignRole('Teacher');

        User::create([
            'user_name' => 'phanthithuha',
            'password' => Hash::make('student'),
            'name' => 'Phan Thị Thu Hà',
            'email_address' => 'thuhaphanlop92@localhost.com',
            'date_of_birth' => '2019-04-07',
            'address' => 'Thừa Thiên Huế',
            'phone_number' => '0396603842',
            'id_salary_recipe' => 1
        ])->assignRole('Student');

        User::create([
            'user_name' => 'dinhduoc.marketing',
            'password' => Hash::make('employee'),
            'name' => 'Trần Đình Được',
            'email_address' => 'tdd@localhost.com',
            'date_of_birth' => '2001-02-02',
            'address' => 'Thua Thien Hue',
            'phone_number' => '0906999777',
            'id_salary_recipe' => 4
        ])->assignRole('Student');

        User::create([
            'user_name' => 'binhdinh.financi',
            'password' => Hash::make('employee'),
            'name' => 'Nguyễn Bình Định',
            'email_address' => 'nbd@localhost.com',
            'date_of_birth' => '2003-05-01',
            'address' => 'Quảng Ngãi',
            'phone_number' => '0906040887',
            'id_salary_recipe' => 4
        ])->assignRole('Teacher');

        User::create([
            'user_name' => 'user1',
            'password' => Hash::make('password'),
            'name' => 'Nguyen Van Anh',
            'email_address' => 'user1@localhost.com',
            'date_of_birth' => '2001-01-05',
            'address' => '76 Vu Lap Street',
            'phone_number' => '0336482923',
            'id_salary_recipe' => 2,
            'userable_id' => 1,
            'userable_type' => Teacher::class
        ])->assignRole('Teacher');
    }
}
