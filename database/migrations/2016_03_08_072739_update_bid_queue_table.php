<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBidQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('bid_queue', function ($table) {
        $table->decimal('tp_curve_poin', 5, 2)->after('total_amount');
        $table->decimal('mp_curve_poin', 5, 2)->after('monthly_amount');
        $table->decimal('acc_curve_poin', 5, 2)->after('mp_curve_poin');
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
