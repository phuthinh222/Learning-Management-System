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
        Schema::create('CenterCost', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->decimal('amount', 15, 2);
            $table->date('date');
            $table->string('description', 1000)->nullable();
            $table->string('note', 1000)->nullable();
            $table->unsignedBigInteger('id_employee');
            $table->timestamps();
            $table->foreign('id_employee')->references('id')->on('users')->onUpdate('cascade');
            $table->softDeletes();
            $table->index(['date', 'amount']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('CenterCost');
    }
};
