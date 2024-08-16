<?php

namespace Database\Seeders;

use App\Models\Employees;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employees::create(['status' => TRUE]);
        Employees::create(['status' => TRUE]);
        Employees::create(['status' => FALSE]);
        Employees::create(['status' => FALSE]);
        Employees::create(['status' => FALSE]);
    }
}
