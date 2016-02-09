<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaryearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('caryear', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('make_id');
            $table->integer('carmodel_id');
            $table->integer('year_id')->unique();
            $table->string('year');
            $table->longText('styles');
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
