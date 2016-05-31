<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealersInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dealers_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dealer_id');
            $table->string('website_url');
            $table->string('phone_no');
            $table->string('email_id');
            $table->longText('contact_address');
            $table->longText('details');
            $table->longText('logo');
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
