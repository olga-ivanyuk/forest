<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->softDeletes()->nullable();
            // extra column with other type
            $table->string('body')->nullable();
            $table->smallInteger('quality')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropSoftDeletes();
            // drop extra column with other type
            $table->dropColumn('body');
            $table->dropColumn('quality');
        });
    }
};
