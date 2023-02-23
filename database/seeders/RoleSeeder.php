<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Admin', 'display_name' => 'Manage System'],
            ['name' => 'Developer', 'display_name' => 'Develop System'],
            ['name' => 'Edittor', 'display_name' => 'Edit System'],
            ['name' => 'Guess', 'display_name' => 'Customer']
        ]);
    }
}
