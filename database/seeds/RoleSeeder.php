<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // Reset cached roles and permissions
          app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

          Role::Create(['name' => 'kepala bahan baku']);
          Role::Create(['name' => 'kepala produksi']);
          Role::Create(['name' => 'direktur umum']);
          Role::Create(['name' => 'staff gudang']);
    }
}
