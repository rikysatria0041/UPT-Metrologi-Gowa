<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        Role::firstOrCreate([
            'name' => 'Perusahaan',
            'guard_name' => 'web'
        ]);
    }
}
