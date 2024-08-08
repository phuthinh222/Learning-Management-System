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
            $table->unsignedBigInteger('id_certificate')->nullable();
            $table->unsignedBigInteger('id_experience')->nullable();
            $table->string('department', 255)->nullable()->default(null);
            $table->string('position', 255)->nullable();
            $table->boolean('status')->nullable();
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
