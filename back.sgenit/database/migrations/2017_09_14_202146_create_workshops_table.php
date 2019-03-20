<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->string('title');
            $table->longText('description');
            $table->integer('hours');
            $table->string('workshop_day');
            $table->timestamps();
        });

        Schema::create('workshop_inscriptions', function (Blueprint $table) {
            $table->integer('inscription_id');
            $table->integer('workshop_id');
            $table->primary(['inscription_id', 'workshop_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshops');
        Schema::dropIfExists('workshop_inscriptions');
    }
}
