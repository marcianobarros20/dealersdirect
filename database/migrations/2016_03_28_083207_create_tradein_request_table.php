<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeinRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tradein_request_queue', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_queue_id');
            $table->integer('make_id');
            $table->integer('carmodel_id');
            $table->string('condition');
            $table->integer('year');
            $table->integer('owe');
            $table->longText('owe_amount');
            $table->longText('fname');
            $table->longText('lname');
            $table->longText('phone');
            $table->longText('email');
            $table->integer('status');
            $table->integer('im_type')->default('0');
            $table->integer('type')->default('0');
            $table->integer('client_id')->default('0');
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
