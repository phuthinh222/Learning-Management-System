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
        Schema::create('salary_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('symbol', 5)->unique();
            $table->decimal('amount', 10, 2);
            $table->timestamps();
            $table->softDeletes();
            $table->index('name');
        });
        
        Schema::create('type_recipes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_type');
            $table->unsignedBigInteger('id_recipe');
            $table->float('factor')->nullable()->default(1);
            $table->foreign('id_recipe')->references('id')->on('salary_recipes')->onDelete('cascade');
            $table->foreign('id_type')->references('id')->on('salary_types')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_types');

        Schema::dropIfExists('type_recipes');
    }
};
