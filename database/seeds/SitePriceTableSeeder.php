<?php

use Illuminate\Database\Seeder;

class SitePriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        DB::table('site_contact_price')
        ->insert(array('id'=>'','added_by'=>'admin','price'=>'50.00'));
    }
}
