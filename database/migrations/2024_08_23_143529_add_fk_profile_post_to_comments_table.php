<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('profile_id')->index()->constrained('profiles');
            $table->foreignId('post_id')->nullable()->index()->constrained('posts');
        });
    }

    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('profile_id');
            $table->dropColumn('post_id');
        });
    }
};
