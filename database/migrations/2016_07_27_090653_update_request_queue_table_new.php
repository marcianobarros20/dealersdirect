<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRequestQueueTableNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('request_queue', function ($table) {
        
        $table->integer('type')->default('0');
        $table->integer('client_id')->default('0');
        $table->integer('im_type')->default('0');
        $table->integer('trade_in')->default('0');
        $table->integer('zip')->default('0')->after('email');
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
