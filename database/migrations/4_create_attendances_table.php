<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Attendance', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time_check_in');
            $table->time('time_check_out');
            $table->timestamps();
            $table->index('date');
        });

        Schema::create('AttendanceTeacher', function (Blueprint $table) {
            $table->unsignedBigInteger('id_teacher');
            $table->unsignedBigInteger('id_attendance');
            $table->foreign('id_teacher')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_attendance')->references('id')->on('Attendance')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Attendance');

        Schema::dropIfExists('AttendanceTeacher');
    }
};
