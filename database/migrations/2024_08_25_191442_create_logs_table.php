<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('post_id');
            $table->string('event_name');
            $table->json('old_attributes')->nullable();
            $table->json('new_attributes')->nullable();
            $table->timestamp('changed_at')->useCurrent()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
