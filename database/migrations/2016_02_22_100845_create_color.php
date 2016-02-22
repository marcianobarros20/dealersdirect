<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requestqueue_id');
            $table->string('style_id');
            $table->string('color_id');
            $table->string('category');
            $table->string('name');
            $table->string('manufactureOptionName');
            $table->string('hex');
            $table->longText('rgb');
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
