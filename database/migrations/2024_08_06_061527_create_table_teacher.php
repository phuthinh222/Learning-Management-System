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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('name', 255);
            $table->date('date_of_birth')->nullable();
            $table->boolean('gender');
            $table->string('email', 255);
            $table->string('phone_number', 15)->nullable();
            $table->string('address', 1000)->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->index('name', 'phone_number');
        });
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_teacher');
            $table->string('major', 255);
            $table->string('level', 255);
            $table->string('school', 1000);
            $table->foreign('id_teacher')->references('id')->on('teachers')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->index('major', 'level');
        });
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_teacher');
            $table->string('position', 255);
            $table->float('year');
            $table->string('company', 1000);
            $table->foreign('id_teacher')->references('id')->on('teachers')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->index('position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_teacher');
    }
};
