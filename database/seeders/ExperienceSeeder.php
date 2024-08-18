<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('experiences')->insert([
            'id_teacher' => 1,
            'position' => 'Dev',
            'year' => '1',
            'company' => 'DEHA Việt Nam'
        ]);
        DB::table('experiences')->insert([
            'id_teacher' => 1,
            'position' => 'Mobile',
            'year' => '1',
            'company' => 'DEHA Việt Nam'
        ]);
        DB::table('experiences')->insert([
            'id_teacher' => 1,
            'position' => 'Scrum Master',
            'year' => '1',
            'company' => 'DEHA Việt Nam'
        ]);
        DB::table('experiences')->insert([
            'id_teacher' => 1,
            'position' => 'Project Manager',
            'year' => '1',
            'company' => 'DEHA Việt Nam'
        ]);
    }
}
