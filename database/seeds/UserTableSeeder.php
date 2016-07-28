<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(LoanTableSeeder::class);
        $datetimes = date('Y-m-d h:m:s');
        DB::table('users')
        ->insert(array('name'=>'admin','email'=>'support@dealers.com', 'password'=>'$2y$10$U6iIRukh6NVmFiz0quAXcOqn5/ZIae5ScnpCnMONazX4kwnOjooDS', 'remember_token'=>'1fimBQBPeE2DjuHNHWz7bklGhxwAThbzl8qcmOQApE7bP9SYMPOP5AlkYcyf', 'created_at'=>$datetimes, 'updated_at'=>$datetimes));
    }
}
