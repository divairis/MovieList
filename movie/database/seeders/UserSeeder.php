<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=2;$i++){ 
            DB::table('users')->insert([
                'username' => "admin$i",
                'email_address' => "admin$i@gmail.com",
                'password' => Hash::make("admin$i"),
                'is_admin' => true,
            ]);
        }
        for($i=1;$i<=6;$i++){
            DB::table('users')->insert([
                'username' => "username$i",
                'email_address' => "username$i@gmail.com",
                'password' => Hash::make("username$i"),
            ]);
        }
    }
}
