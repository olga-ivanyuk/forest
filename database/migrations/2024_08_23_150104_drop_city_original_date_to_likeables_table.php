<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('likeables', function (Blueprint $table) {
           $table->dropColumn('city');
           $table->dropColumn('original');
        });
    }

    public function down(): void
    {
        Schema::table('likeables', function (Blueprint $table) {
            $table->boolean('city')->nullable();
            $table->tinyText('original')->nullable();
        });
    }
};
