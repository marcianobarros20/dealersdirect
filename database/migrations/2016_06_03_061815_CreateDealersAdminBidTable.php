<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealersAdminBidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dealers_admin_bid_management', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dealer_id');
            $table->integer('parent_id');
            $table->float('total_amount_per_bid');
            $table->float('monthly_amount_per_bid');
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
