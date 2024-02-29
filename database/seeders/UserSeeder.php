<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        // akun super admin
        $superadmin = User::firstOrCreate([
            'name' => 'superadmin',
            'email' => 'super.admin@gmail.com',
            'password' => Hash::make('superadmin123'),
        ]);
        $superadmin->assignRole(1);

        // akun admin
        $admin = User::firstOrCreate([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
        $admin->assignRole(2);
    }
}
