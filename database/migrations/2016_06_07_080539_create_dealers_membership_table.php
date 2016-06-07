<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealersMembershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('dealers_membership_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dealer_id');
            $table->enum('membership_type', ['1', '2','3'])->comment('1=>Level One 2=>Level Two 3=>Level Three');
            $table->enum('is_active',['0','1'])->default(1)->comment('0=>inactive 1=>active');
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
