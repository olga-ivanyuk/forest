<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->text('content')->nullable();
            $table->softDeletes()->nullable();
            // extra column with other type
            $table->string('array')->nullable();
            $table->tinyText('finish_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('content');
           $table->dropSoftDeletes();
            // drop extra column with other type
            $table->dropColumn('array');
            $table->dropColumn('finish_date');
        });
    }
};
