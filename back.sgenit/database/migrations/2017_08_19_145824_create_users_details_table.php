<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_details', function (Blueprint $table) {
            $table->string('user_id')->unique();
            $table->string('bond_id');
            $table->string('name_tag');
            $table->string('occupation_area');
            $table->string('institution');
            $table->string('phone');
        });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
    public function down()
    {
        Schema::dropIfExists('users_details');
    }
}
