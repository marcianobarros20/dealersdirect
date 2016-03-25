<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdmundsStyleImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('edmunds_style_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('make_id');
            $table->integer('model_id');
            $table->integer('year_id');
            $table->integer('style_id');
            $table->longText('title');
            $table->string('category');
            $table->longText('edmunds_path_big');
            $table->longText('edmunds_path_small');
            $table->longText('local_path_big');
            $table->longText('local_path_smalll');
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
        //
    }
}
