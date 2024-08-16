<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teachers')->insert([
            'department' => 'class',
            'position' => 'developer',
            'status' => 1,
        ]);

        DB::table('teachers')->insert([
            'department' => 'class',
            'position' => 'developer',
            'status' => 1,
        ]);

        DB::table('teachers')->insert([
            'department' => 'class',
            'position' => 'developer',
            'status' => 1,
        ]);

        DB::table('teachers')->insert([
            'department' => 'class',
            'position' => 'developer',
            'status' => 1,
        ]);

        DB::table('teachers')->insert([
            'department' => 'class',
            'position' => 'developer',
            'status' => 1,
        ]);
    }
}
