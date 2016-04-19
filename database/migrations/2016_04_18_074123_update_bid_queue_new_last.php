<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBidQueueNewLast extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void dealer_admin
     */
    public function up()
    {
        //
        Schema::table('request_dealer_log', function ($table) {
        
        $table->integer('dealer_admin')->default('0')->after('dealer_id');;
                
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
