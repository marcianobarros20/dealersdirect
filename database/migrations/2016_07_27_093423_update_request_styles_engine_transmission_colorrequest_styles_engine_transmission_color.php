<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRequestStylesEngineTransmissionColorrequestStylesEngineTransmissionColor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('request_styles_engine_transmission_color', function ($table) {
        $table->dropColumn('color_id');
        $table->string('exterior_color_id');
        $table->string('interior_color_id')->after('exterior_color_id');
        
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
