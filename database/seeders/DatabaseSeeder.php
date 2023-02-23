<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call([
            AccountSeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            // AttributeProductSeeder::class,
            // ProductVariantSeeder::class,
            // ProductImageSeeder::class,
        ]);
    }
}
