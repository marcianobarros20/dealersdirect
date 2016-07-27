<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDealerTableNewone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('dealers', function ($table) {
        $table->integer('status')->default('0')->after('code_number');
        $table->integer('zip')->default('0')->after('email');
        $table->integer('parent_id')->default('0')->after('id');
        $table->string('dealership_name')->after('parent_id');
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
