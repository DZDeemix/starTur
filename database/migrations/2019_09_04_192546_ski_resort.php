<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SkiResort extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ski_resort', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('lift_count_bugel');
            $table->integer('lift_count_sit');
            $table->integer('lift_count_ropeway');
            $table->string('height_diff');
            $table->integer('track_length');
            $table->date('start_season_date');
            $table->date('end_season_date');
            $table->string('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ski_resort');
    }
}
