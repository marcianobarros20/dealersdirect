<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFUELAPIProductsImagesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuelapiproductsimagesdata', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('img_pid');
            $table->string('fuelImg_big_jpgformat');
            $table->string('fuelImg_small_jpgformat');
            $table->string('fuelImg_big_jpgformatlocal');
            $table->string('fuelImg_small_jpgformatlocal');
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
        Schema::drop('fuelapiproductsimagesdata');
    }
}
