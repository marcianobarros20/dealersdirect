<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFUELAPIProductsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuelapiproductsdata', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('make_id');
            $table->integer('model_id');
            $table->integer('year');
            $table->string('product_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     *
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fuelapiproductsdata');
    }
}
