<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            'id_teacher' => 1,
            'photo' => 'https://images.unsplash.com/photo-1719937051230-8798ae2ebe86?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'title' => 'DEV PHP Stanrd',
            'description' => 'Kiến thức về PHP, Laravel',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('courses')->insert([
            'id_teacher' => 1,
            'photo' => 'https://images.unsplash.com/photo-1719937051230-8798ae2ebe86?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'title' => 'Mobile Flutter Stanrd',
            'description' => 'Kiến thức về lập trình mobile',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('courses')->insert([
            'id_teacher' => 1,
            'photo' => 'https://images.unsplash.com/photo-1719937051230-8798ae2ebe86?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'title' => '.NET Stanrd',
            'description' => 'Kiến thức về lập trình .net',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
