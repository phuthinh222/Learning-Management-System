<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('certificates')->insert([
            'id_teacher' => 1,
            'major' => 'CNTT',
            'level' => 'Cử nhân',
            'school' => 'DEHA Acedemy'
        ]);
        DB::table('certificates')->insert([
            'id_teacher' => 1,
            'major' => 'CNTT',
            'level' => 'Kỹ sư',
            'school' => 'DEHA Acedemy'
        ]);
        DB::table('certificates')->insert([
            'id_teacher' => 1,
            'major' => 'Tester',
            'level' => 'Cử nhân',
            'school' => 'DEHA Acedemy'
        ]);
    }
}
