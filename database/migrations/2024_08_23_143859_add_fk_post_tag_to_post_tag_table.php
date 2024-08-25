<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('post_tag', function (Blueprint $table) {
            $table->foreignId('post_id')->index()->constrained('posts');
            $table->foreignId('tag_id')->index()->constrained('tags');
        });
    }

    public function down(): void
    {
        Schema::table('post_tag', function (Blueprint $table) {
            $table->dropColumn('post_id');
            $table->dropColumn('tag_id');
        });
    }
};
