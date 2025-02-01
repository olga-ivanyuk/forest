<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('likeables', function (Blueprint $table) {
            $table->string('city')->change();
            $table->boolean('original')->change();

            DB::statement('ALTER TABLE likeables ALTER COLUMN original TYPE boolean USING (original::boolean)');
        });
    }


    public function down()
    {
        Schema::table('likeables', function (Blueprint $table) {
            $table->boolean('city')->change();
            $table->tinyText('original')->change();

            DB::statement('ALTER TABLE likeables ALTER COLUMN city TYPE boolean USING (city::boolean)');
        });
    }
};
