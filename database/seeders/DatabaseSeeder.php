<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Certificate;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            SalarySeeder::class,
            UserSeeder::class,
            AttendanceSeeder::class,
            CenterCostSeeder::class,
            StudentSeeder::class,
            SubjectSeeder::class,
            TimeLineSeeder::class,
            AttendanceOfStudent::class,
            TeacherSeeder::class,
            CertificatesSeeder::class,
            ExperienceSeeder::class,
        ]);
    }
}
