<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->string('array')->change();
            $table->date('finish_date')->change();
            DB::statement('ALTER TABLE comments ALTER COLUMN finish_date TYPE date USING (finish_date::date)');
        });
    }

    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->text('array')->change();
            $table->tinyText('finish_date')->change();
        });
    }
};
