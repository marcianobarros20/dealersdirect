<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFUELAPIProductsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('fuelapiproductsdata', function(Blueprint $table)
        {
        $table->string('trim');
        $table->string('body');
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
        
        $table->dropColumn('trim');
        $table->dropColumn('body');

        
        
    }
}
