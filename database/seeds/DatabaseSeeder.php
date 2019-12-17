<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->inserts([
        	'name'=>'ngọc anh',
        	'email'=>'anh@gmail.com',
        	'password'=>bcrypt('matkhau')
        ]);
    }
}
