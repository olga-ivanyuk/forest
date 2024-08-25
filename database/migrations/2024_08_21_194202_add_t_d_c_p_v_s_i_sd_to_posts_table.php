<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->unsignedInteger('views')->nullable();
            $table->unsignedSmallInteger('status')->default(1);
            $table->string('image_path')->nullable();
            $table->softDeletes()->nullable();
            // extra column with other type
            $table->string('body')->nullable();
            $table->integer('size')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
           $table->dropColumn('title');
           $table->dropColumn('description');
           $table->dropColumn('content');
           $table->dropColumn('published_at');
           $table->dropColumn('views');
           $table->dropColumn('status');
           $table->dropColumn('image_path');
           $table->dropSoftDeletes();
           // drop extra column with other type
            $table->dropColumn('body');
            $table->dropColumn('size');
        });
    }
};
