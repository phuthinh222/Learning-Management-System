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
        Schema::create('attendance_students', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->boolean('is_attend');
            $table->unsignedBigInteger('id_student');
            $table->unsignedBigInteger('id_subject');
            $table->timestamps();
            $table->foreign('id_student')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('id_subject')->references('id')->on('subjects')->onDelete('cascade');
            $table->softDeletes();
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_students');
    }
};
