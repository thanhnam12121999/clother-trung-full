<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Manager;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        echo "RUNNING...\n";
        DB::table('accounts')->truncate();
        DB::table('managers')->truncate();

        DB::table('managers')->insert([
            'role' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('accounts')->insert([
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'phone_number' => '0987654321',
            'name' => 'Admin',
            'gender' => 1,
            'date_of_birth' => '1999-01-01',
            'avatar' => '',
            'accountable_id' => 1,
            'accountable_type' => Manager::class,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Account::factory()->count(1)->for(
            Manager::factory(), 'accountable'
        )->create();
        echo "FINISH!\n";

        Schema::enableForeignKeyConstraints();
    }
}
