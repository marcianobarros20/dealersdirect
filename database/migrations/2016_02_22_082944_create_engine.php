<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('engine', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requestqueue_id');
            $table->string('style_id');
            $table->string('engine_id');

            $table->string('name');
            $table->string('equipmentType');
            $table->string('compressionRatio');
            $table->string('cylinder');
            $table->string('size');
            $table->string('displacement');
            $table->string('configuration');
            $table->string('fuelType');
            $table->string('horsepower');
            $table->string('torque');
            $table->string('totalValves');
            $table->string('type');
            $table->string('code');
            $table->string('compressorType');
            $table->longText('rpm');
            $table->longText('valve');
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
