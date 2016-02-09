<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidStopLogDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('bid_stop_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requestqueue_id');
            $table->string('dealer_id');
            $table->string('bid_id');
            $table->longText('total_amount');
            $table->decimal('tp_curve_poin', 5, 2);
            $table->longText('monthly_amount');
            $table->decimal('mp_curve_poin', 5, 2);
            $table->decimal('acc_curve_poin', 5, 2);
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
