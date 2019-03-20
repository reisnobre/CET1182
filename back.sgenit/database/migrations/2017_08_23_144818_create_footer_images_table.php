<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFooterImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('template_id');
            $table->string('hash_name');
            $table->string('original_name');
            $table->string('file_extension');
            $table->timestamps();
        });

        Schema::create('footer_image_template', function (Blueprint $table) {
            $table->integer('footer_image_id');
            $table->integer('template_id');
            $table->primary(['footer_image_id', 'template_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('footer_images');
        Schema::dropIfExists('footer_image_template');
    }
}
