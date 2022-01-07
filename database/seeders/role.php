<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        ["role_name"=>"super admin"],
        ["role_name"=>"admin"],
        ["role_name"=>"inventory manager"],
        ["role_name"=>"order manager"],
        ["role_name"=>"customer"],
        ]);
    }
}
