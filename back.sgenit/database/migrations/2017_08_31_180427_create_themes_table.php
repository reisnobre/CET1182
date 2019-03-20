<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->string('dark_muted')->nullable();
            $table->string('dark_vibrant')->nullable();
            $table->string('light_muted')->nullable();
            $table->string('light_vibrant')->nullable();
            $table->string('muted')->nullable();
            $table->string('vibrant')->nullable();
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
        Schema::dropIfExists('themes');
    }
}
