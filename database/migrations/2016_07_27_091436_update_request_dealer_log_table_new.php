<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRequestDealerLogTableNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('request_dealer_log', function ($table) {
        
        $table->integer('make_id');
        $table->string('bid_flag')->after('make_id')->default(0);
        $table->integer('blocked')->default('0')->after('status');
        $table->integer('dealer_admin')->default('0')->after('dealer_id');
        $table->string('req_contact')->after('bid_flag')->default(0);
        $table->string('payment_status')->after('req_contact')->default(0);
        $table->integer('reserved')->default('0')->after('blocked');
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
