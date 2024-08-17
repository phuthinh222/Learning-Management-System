<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS remove_accents');
        DB::unprepared('
            CREATE function remove_accents(input NVARCHAR(255))
            RETURNS VARCHAR(255)
            DETERMINISTIC
            BEGIN
                DECLARE output VARCHAR(255);
                SET output = input;
                SET output = REPLACE(input, "đ", "d");
                SET output = REPLACE(input, "Đ", "D");
                
                RETURN output;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS remove_accents');
    }
};
