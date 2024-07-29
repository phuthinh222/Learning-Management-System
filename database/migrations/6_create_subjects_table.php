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
        Schema::create('Subject', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->decimal('amount', 10, 2);
            $table->date('date_begin');
            $table->float('total_month');
            $table->integer('date_in_week');
            $table->time('time_start');
            $table->float('time_one_session');
            $table->unsignedBigInteger('id_teacher');
            $table->timestamps();
            $table->foreign('id_teacher')->references('id')->on('users')->onUpdate('cascade');
            $table->softDeletes();
            $table->index('name');
        });

        Schema::create('StudyFee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_subject')->default(1);
            $table->unsignedBigInteger('id_student')->default(1);
            $table->unsignedBigInteger('id_employee')->default(1);
            $table->date('date_collect')->nullable();
            $table->timestamps();
            $table->foreign('id_subject')->references('id')->on('Subject')->onDelete('SET DEFAULT');
            $table->foreign('id_student')->references('id')->on('Student')->onDelete('SET DEFAULT');
            $table->foreign('id_employee')->references('id')->on('users')->onDelete('SET DEFAULT');
            $table->softDeletes();
            $table->index(['id_student', 'id_employee', 'date_collect']);
        });

        Schema::create('Grade', function (Blueprint $table) {
            $table->unsignedBigInteger('id_student');
            $table->unsignedBigInteger('id_subject');
            $table->float('grade');
            $table->timestamps();
            $table->index('grade');
            $table->foreign('id_subject')->references('id')->on('Subject')->onDelete('cascade');
            $table->foreign('id_student')->references('id')->on('Student')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Subject');
        Schema::dropIfExists('Grade');
        Schema::dropIfExists('StudyFee');
    }
};
