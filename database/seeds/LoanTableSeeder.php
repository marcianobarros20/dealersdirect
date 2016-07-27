<?php

use Illuminate\Database\Seeder;

class LoanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(LoanTableSeeder::class);
        DB::table('loans')
        ->insert(array('rateofinterest'=>'8.5','terms'=>'5'));
    }
}
