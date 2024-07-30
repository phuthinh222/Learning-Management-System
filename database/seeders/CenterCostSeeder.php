<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CenterCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('center_costs')->insert([
            [
                'name' => 'Tiền Điện Tháng 6',
                'amount' => 1000000,
                'date' => '2024-07-01',
                'description' => 'Trả tiền điện mà trung tâm đã sử dụng trong tháng 6',
                'note' => 'Không có',
                'id_employee' => '3'
            ],
            [
                'name' => 'Tiền Nước Tháng 6',
                'amount' => 500000,
                'date' => '2024-07-01',
                'description' => 'Trả tiền nước mà trung tâm đã sử dụng trong tháng 6',
                'note' => 'Không có',
                'id_employee' => '3'
            ],
            [
                'name' => 'Thuế Công ty',
                'amount' => 1600000,
                'date' => '2024-07-01',
                'description' => 'Đóng thuế Nhà nước',
                'note' => 'Không có',
                'id_employee' => '6'
            ]
        ]);
    }
}
