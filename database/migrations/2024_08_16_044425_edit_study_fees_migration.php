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
        Schema::table('study_fees', function (Blueprint $table) {
            $table->dropForeign(['id_employee']);
            $table->dropColumn('id_employee');
            $table->unsignedBigInteger('id_employee')->after('id_student'); 
            $table->foreign('id_employee')->references('id')->on('employees')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('study_fees', function (Blueprint $table) {
            $table->dropForeign(['id_employee']);
            $table->dropColumn('id_employee');
            $table->unsignedBigInteger('id_employee')->after('id_student'); 
            $table->foreign('id_employee')->references('id')->on('users')->onUpdate('cascade');
        });
    }
};
