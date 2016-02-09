<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('makes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('makes_id')->unique();
            $table->string('name');
            $table->string('nice_name');
            $table->longText('models');
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
        Schema::drop('makes');
    }
}
