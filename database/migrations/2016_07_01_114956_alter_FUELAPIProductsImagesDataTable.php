<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFUELAPIProductsImagesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('fuelapiproductsimagesdata', function (Blueprint $table) {

            $table->integer('make_id')->after('img_pid');
            $table->integer('model_id');
            $table->integer('year');
            $table->string('trim');

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
            $table->dropColumn('make_id');
            $table->dropColumn('model_id');
            $table->dropColumn('year');
            $table->dropColumn('trim');
    }
}
