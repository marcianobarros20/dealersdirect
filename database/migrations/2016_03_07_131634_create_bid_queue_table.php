<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bid_queue', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requestqueue_id');
            $table->string('dealer_id');
            $table->string('bid_id');
            $table->longText('total_amount');
            $table->longText('monthly_amount');
            $table->longText('details');
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
