<?php

namespace Database\Seeders;

use App\Models\Employees;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
            'id_salary_recipe' => 3,
            'userable_id' => 2,
            'userable_type' => Teacher::class,
        ])->assignRole('Teacher');

        User::create([
            'user_name' => 'dophuthinh',
            'password' => Hash::make('employee'),
            'name' => 'Đỗ Phú Thịnh',
            'email_address' => 'dpt@localhost.com',
            'date_of_birth' => '2002-02-02',
            'address' => 'Thua Thien Hue',
            'phone_number' => '0906040334',
            'id_salary_recipe' => 4,
            'userable_id' => 3,
            'userable_type' => Employees::class
        ])->assignRole('Employee');

        User::create([
            'user_name' => 'phanngockhai',
            'password' => Hash::make('student'),
            'name' => 'Phan Ngọc Khải',
            'email_address' => 'pnk@localhost.com',
            'date_of_birth' => '2012-02-02',
            'address' => 'Thua Thien Hue',
            'phone_number' => '0906222334',
            'id_salary_recipe' => 1,
            'userable_id' => 1,
            'userable_type' => Student::class
        ])->assignRole('Student');

        User::create([
            'user_name' => 'tranngoc.teacher',
            'password' => Hash::make('employee'),
            'name' => 'Nguyễn Bình Định',
            'email_address' => 'trngoc@localhost.com',
            'date_of_birth' => '2003-05-01',
            'address' => 'Quảng Ngãi',
            'phone_number' => '0906040654',
            'id_salary_recipe' => 3,
            'userable_id' => 3,
            'userable_type' => Teacher::class
        ])->assignRole('Teacher');

        User::create([
            'user_name' => 'phanthithuha',
            'password' => Hash::make('student'),
            'name' => 'Phan Thị Thu Hà',
            'email_address' => 'thuhaphanlop92@localhost.com',
            'date_of_birth' => '2019-04-07',
            'address' => 'Thừa Thiên Huế',
            'phone_number' => '0396603842',
            'id_salary_recipe' => 1,
            'userable_id' => 2,
            'userable_type' => Student::class
        ])->assignRole('Student');

        User::create([
            'user_name' => 'dinhduoc.marketing',
            'password' => Hash::make('employee'),
            'name' => 'Trần Đình Được',
            'email_address' => 'tdd@localhost.com',
            'date_of_birth' => '2001-02-02',
            'address' => 'Thua Thien Hue',
            'phone_number' => '0906999777',
            'id_salary_recipe' => 4,
            'userable_id' => 4,
            'userable_type' => Employees::class
        ])->assignRole('Employee');

        User::create([
            'user_name' => 'binhdinh.financi',
            'password' => Hash::make('employee'),
            'name' => 'Nguyễn Bình Định',
            'email_address' => 'nbd@localhost.com',
            'date_of_birth' => '2003-05-01',
            'address' => 'Quảng Ngãi',
            'phone_number' => '0906040887',
            'id_salary_recipe' => 4,
            'userable_id' => 5,
            'userable_type' => Employees::class
        ])->assignRole('Employee');

        User::create([
            'user_name' => 'teacher1',
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

        User::create([
            'user_name' => 'employee1',
            'password' => Hash::make('password'),
            'name' => 'Nguyễn Bá Học',
            'email_address' => 'employee1@localhost.com',
            'date_of_birth' => '2001-01-05',
            'address' => '76 Vu Lap Street',
            'phone_number' => '0337482712',
            'id_salary_recipe' => 2,
            'userable_id' => 1,
            'userable_type' => Employees::class
        ])->assignRole('Employee');
        
        User::create([
            'user_name' => 'employee2',
            'password' => Hash::make('password'),
            'name' => 'Nguyễn Bá Học',
            'email_address' => 'employee2@localhost.com',
            'date_of_birth' => '2001-01-05',
            'address' => '76 Vu Lap Street',
            'phone_number' => '0337482713',
            'id_salary_recipe' => 2,
            'userable_id' => 2,
            'userable_type' => Employees::class
        ])->assignRole('Employee');

        User::create([
            'user_name' => 'teacher2',
            'password' => Hash::make('teacher'),
            'name' => 'Trịnh Trần Phương Tuấn',
            'email_address' => 'meomewmoe@localhost.com',
            'date_of_birth' => '2001-01-05',
            'address' => '76 Vu Lap Street',
            'phone_number' => '0336482900',
            'id_salary_recipe' => 2,
            'userable_id' => 4,
            'userable_type' => Teacher::class
        ])->assignRole('Teacher');

        User::create([
            'user_name' => 'teacher3',
            'password' => Hash::make('teacher'),
            'name' => 'Phan Bảo Khánh',
            'email_address' => 'kicmno1@localhost.com',
            'date_of_birth' => '2001-01-05',
            'address' => '76 Vu Lap Street',
            'phone_number' => '0336482934',
            'id_salary_recipe' => 2,
            'userable_id' => 5,
            'userable_type' => Teacher::class
        ])->assignRole('Teacher');
        
        User::create([
            'user_name' => 'student1',
            'password' => Hash::make('student'),
            'name' => 'Nguyễn Trần Trung Quân',
            'email_address' => 'student1@localhost.com',
            'date_of_birth' => '2012-02-02',
            'address' => 'Thua Thien Hue',
            'phone_number' => '0906222309',
            'id_salary_recipe' => 1,
            'userable_id' => 3,
            'userable_type' => Student::class
        ])->assignRole('Student');

        User::create([
            'user_name' => 'student2',
            'password' => Hash::make('student'),
            'name' => 'Monkey D.Luffy',
            'email_address' => 'luffythepiratekig@localhost.com',
            'date_of_birth' => '2012-02-02',
            'address' => 'Thua Thien Hue',
            'phone_number' => '0906222998',
            'id_salary_recipe' => 1,
            'userable_id' => 4,
            'userable_type' => Student::class
        ])->assignRole('Student');
    }
}
