<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->softDeletes()->nullable();
            // extra column with other type
            $table->string('quantity')->nullable();
            $table->time('original')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropSoftDeletes();
            // drop extra column with other type
            $table->dropColumn('quantity');
            $table->dropColumn('original');
        });
    }
};
