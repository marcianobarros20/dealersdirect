<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestQueueTableNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('request_queue', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('make_id');
            $table->integer('carmodel_id');
            $table->string('condition');
            $table->integer('year');
            $table->longText('total_amount');
            $table->longText('monthly_amount');
            $table->longText('fname');
            $table->longText('lname');
            $table->longText('phone');
            $table->longText('email');
            $table->integer('status');
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
