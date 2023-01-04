<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cinema', function (Blueprint $table) {
            $table->id("movieId");
            $table->string('movieImg');
            $table->string('movieTitle');
            $table->string('movieGenre');
            $table->integer('movieDuration');
            $table->date('movieRelDate');
            $table->string('movieDirector');
            $table->string('movieActors');
            $table->string('Description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cinema');
    }
};
