<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name'=>'admin',
            'last_name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>hash::make('admin123'),
            'role_id'=>2
        
        ]);
    }
}
