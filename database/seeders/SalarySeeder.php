<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('salary_recipes')->insert([
            [
                'name' => 'Stydent Salary',
                'total_salary' => 0
            ],
            [
                'name' => 'Manager Salary',
                'total_salary' => 15000000
            ],
            [
                'name' => 'Teacher Salary',
                'total_salary' => 6600000
            ], 
            [
                'name' => 'Financial Employee Salary',
                'total_salary' => 7000000
            ]
        ]);

        DB::table('salary_types')->insert([
            [
                'name' => 'Lương Cứng Quản trị',
                'symbol' => 'LCQT',
                'amount' => 10000000
            ],
            [
                'name' => 'Lương Cứng Nhân Viên Tài Chính',
                'symbol' => 'LCF',
                'amount' => 3500000
            ],
            [
                'name' => 'Lương Cứng Giáo Viên',
                'symbol' => 'LCT',
                'amount' => 2500000
            ],
            [
                'name' => 'Lương Cứng Nhân Viên Marketing',
                'symbol' => 'LCM',
                'amount' => 3300000
            ],
            [
                'name' => 'Trợ cấp xăng xe',
                'symbol' => 'TCX',
                'amount' => 300000
            ],
            [
                'name' => 'Trợ cấp nhà ở',
                'symbol' => 'TCN',
                'amount' => 800000
            ],
            [
                'name' => 'Thưởng Tháng',
                'symbol' => 'KPI',
                'amount' => 500000
            ],
        ]);

        DB::table('type_recipes')->insert([
            [
                'id_type' => 1,
                'id_recipe' => 2,
                'factor' => 1.5
            ],
            [
                'id_type' => 2,
                'id_recipe' => 4,
                'factor' => 2
            ],
            [
                'id_type' => 3,
                'id_recipe' => 3,
                'factor' => 2
            ],
            [
                'id_type' => 5,
                'id_recipe' => 3,
                'factor' => 1,
            ],
            [
                'id_type' => 6,
                'id_recipe' => 3,
                'factor' => 1
            ],
            [
                'id_type' => 7,
                'id_recipe' => 3,
                'factor' => 1
            ]
        ]);
    }
}
