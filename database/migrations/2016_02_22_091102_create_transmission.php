<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransmission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('transmissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requestqueue_id');
            $table->string('style_id');
            $table->string('transmission_id');
            $table->string('name');
            $table->string('equipmentType');
            $table->string('transmissionType');
            $table->string('numberOfSpeeds');
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
