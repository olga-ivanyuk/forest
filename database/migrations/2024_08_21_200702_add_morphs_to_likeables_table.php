<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('likeables', function (Blueprint $table) {
            $table->morphs('likeable');
            // extra column with other type
            $table->boolean('city')->nullable();
            $table->tinyText('original')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('likeables', function (Blueprint $table) {
            $table->dropMorphs('likeable');
            // drop extra column with other type
            $table->dropColumn('city');
            $table->dropColumn('original');
        });
    }
};
