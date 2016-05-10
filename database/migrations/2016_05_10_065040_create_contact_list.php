<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('contact_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('request_id');
            $table->string('bid_id');
            $table->string('dealer_id');
            $table->string('admin_id');
            $table->string('client_id');
            $table->string('contact_details');
            $table->string('payment_status');
            $table->string('status');
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
