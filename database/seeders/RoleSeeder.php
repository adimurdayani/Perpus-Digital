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
        $roles = ['administrator', 'petugas', 'peminjam'];

        foreach ($roles as $role) {
            Role::create(['nama_role' => $role]);
        }
    }
}
