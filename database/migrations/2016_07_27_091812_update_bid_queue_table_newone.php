<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBidQueueTableNewone extends Migration
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
        $table->integer('status')->after('acc_curve_poin');
        $table->longText('details_of_actions')->after('status');
        $table->integer('visable')->default('1')->after('details_of_actions');
        $table->decimal('trade_in', 15, 2)->default('0')->after('visable');
        $table->integer('dealer_admin')->default('0')->after('dealer_id');
        $table->string('req_contact')->after('details')->default(0);
            $table->string('payment_status')->after('req_contact')->default(0);
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
