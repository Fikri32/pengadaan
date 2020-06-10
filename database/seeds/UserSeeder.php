<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::Create([
            'name' => 'Kepala Gudang',
            'email' => 'kepala@gudang.com',
            'password' => bcrypt('admin123')
        ]);
        $user->assignRole('kepala bahan baku');

        $produksi = User::Create([
            'name' => 'Kepala Produksi',
            'email' => 'kepalaproduksi@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        $produksi->assignRole('kepala produksi');

        $manager = User::Create([
            'name' => 'Manager Umum',
            'email' => 'managerumum@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        $manager->assignRole('manager umum');

        $staff = User::Create([
            'name' => 'Staff Gudang',
            'email' => 'staffgudang@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        $staff->assignRole('staff gudang');

    }
}
