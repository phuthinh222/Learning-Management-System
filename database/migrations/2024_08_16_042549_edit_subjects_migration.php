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
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['id_teacher']);
            $table->dropColumn('id_teacher');
            $table->unsignedBigInteger('id_teacher')->after('time_one_session'); 
            $table->foreign('id_teacher')->references('id')->on('teachers')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['id_teacher']);
            $table->dropColumn('id_teacher');
            $table->unsignedBigInteger('id_teacher')->after('some_column'); 
            $table->foreign('id_teacher')->references('id')->on('users')->onUpdate('cascade');
        });
    }
};
