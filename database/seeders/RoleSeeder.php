<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $role_admin = Role::create([
            'name' => 'rol administrator',
            'description' => 'rol administrator',
            'str' => 'role_administrator',
        ]);

        $role_user = Role::create([
            'name' => 'rol viewer',
            'description' => 'rol viewer',
            'str' => 'role_viewer',
        ]);
    }
}
