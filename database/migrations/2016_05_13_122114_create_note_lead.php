<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteLead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('note_lead', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lead_id');
            $table->string('contact_id');
            $table->string('dealer_id');
            $table->string('admin_id');
            $table->string('note');
            $table->date('rdate');
            $table->time('rtime');
            $table->string('head');
            $table->string('cvisability');
            $table->string('status');
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
