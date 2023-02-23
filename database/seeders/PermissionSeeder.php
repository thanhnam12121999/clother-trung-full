<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        foreach (config('permission.permissions') as $key => $value) {
            $permissions = Permission::create([
                'key' => '',
                'name' => $key,
                'group' => 0
            ]);
            foreach ($value as  $keyPermission => $permission) {
                Permission::create([
                    'key' => '',
                    'name' => $key. '-' .$permission,
                    'group' => $permissions->id,
                ]);
            }
        }
    }
}
