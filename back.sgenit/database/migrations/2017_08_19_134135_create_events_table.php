<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('hours_listener');
            $table->integer('hours_staff');
            $table->integer('template_id');
            $table->integer('user_id');
            $table->longText('description');
            $table->string('edital')->nullable();
            $table->string('event_end');
            $table->string('event_start');
            $table->string('location');
            $table->string('site_url');
            $table->string('sponsor')->nullable();
            $table->string('subscriptions_end');
            $table->string('subscriptions_start');
            $table->string('title');
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
        Schema::dropIfExists('events');
    }
}
