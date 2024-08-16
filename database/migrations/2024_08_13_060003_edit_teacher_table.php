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
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropForeign('teachers_id_certificate_foreign');
            $table->dropForeign('teachers_id_experience_foreign');
            $table->dropColumn(['id_certificate', 'id_experience']);
            $table->dropColumn('photo');
        });
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('id_teacher')->nullable();
            $table->foreign('id_teacher')->references('id')->on('teachers')->onDelete('cascade');
        });
        Schema::table('experiences', function (Blueprint $table) {
            $table->unsignedBigInteger('id_teacher')->nullable();
            $table->foreign('id_teacher')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('experiences');
    }
};
