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
            'photo' => 'https://images.unsplash.com/photo-1724055420328-184b76676138?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1OXx8fGVufDB8fHx8fA%3D%3D',
            'title' => 'DEV PHP Stanrd',
            'description' => 'Kiến thức về PHP, Laravel',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('courses')->insert([
            'id_teacher' => 1,
            'photo' => 'https://images.unsplash.com/photo-1724055420328-184b76676138?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1OXx8fGVufDB8fHx8fA%3D%3D',
            'title' => 'Mobile Flutter Stanrd',
            'description' => 'Kiến thức về lập trình mobile',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('courses')->insert([
            'id_teacher' => 1,
            'photo' => 'https://images.unsplash.com/photo-1724055420328-184b76676138?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1OXx8fGVufDB8fHx8fA%3D%3D',
            'title' => '.NET Stanrd',
            'description' => 'Kiến thức về lập trình .net',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
