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
            $table->unsignedBigInteger('id_certificate');
            $table->unsignedBigInteger('id_experience');
            $table->string('department', 255);
            $table->string('position', 255);
            $table->boolean('status');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_certificate')->references('id')->on('certificates')->onDelete('cascade');
            $table->foreign('id_experience')->references('id')->on('experiences')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->index('department', 'status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
