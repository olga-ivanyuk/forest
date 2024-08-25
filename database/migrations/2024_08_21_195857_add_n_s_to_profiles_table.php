<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->softDeletes()->nullable();
            // extra column with other type
            $table->boolean('height')->nullable();
            $table->text('weight')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropSoftDeletes();
            // drop extra column with other type
            $table->dropColumn('height');
            $table->dropColumn('weight');
        });
    }
};
