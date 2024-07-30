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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name', 255);
            $table->string('password', 255);
            $table->string('name', 255);
            $table->string('email_address', 255)->unique();
            $table->string('google_id', 255)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address', 1000)->nullable();
            $table->string('phone_number', 15)->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verify_token', 15)->nullable();
            $table->unsignedBigInteger('id_salary_recipe')->default(1);
            $table->foreign('id_salary_recipe')->references('id')->on('salary_recipes')->onUpdate('cascade');
            $table->index(['email_address', 'name', 'phone_number']);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number', 15);
            $table->string('email_address', 255)->nullable();
            $table->string('address', 1000)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('name', 'phone_number');
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('note', 1000)->nullable();
            $table->float('average_grade')->nullable();
            $table->unsignedBigInteger('id_parent');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_parent')->references('id')->on('parents')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->index('average_grade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('students');
        Schema::dropIfExists('parents');
    }
};
