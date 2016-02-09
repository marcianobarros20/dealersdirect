<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestStyleEngineTransmissionColor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('request_styles_engine_transmission_color', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requestqueue_id');
            $table->string('style_id');
            $table->string('engine_id');
            $table->string('transmission_id');
            $table->string('color_id');
            $table->integer('count');
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
