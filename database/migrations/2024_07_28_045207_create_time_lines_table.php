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
        Schema::create('time_lines', function (Blueprint $table) {
            $table->id();
            $table->string('job_to_do');
            $table->date('date_start');
            $table->date('date_end');
            $table->string('result_must_reach');
            $table->boolean('is_weekly')->nullable();
            $table->boolean('is_monthly')->nullable();
            $table->unsignedBigInteger('id_employee');
            $table->timestamps();
            $table->foreign('id_employee')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->index(['job_to_do', 'date_start', 'date_end', 'result_must_reach']);
        });

        Schema::create('marketings', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('content', 10000);
            $table->date('date_post');
            $table->unsignedBigInteger('id_employee')->default(0);
            $table->foreign('id_employee')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->index(['title', 'date_post']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_lines');

        Schema::dropIfExists('marketings');
    }
};
