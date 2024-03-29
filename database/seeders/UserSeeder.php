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
        User::create([
            'role_id' => 1,
            'nama_lengkap' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'alamat' => 'Kota Palopo',
            'password' => Hash::make('1234567890'),
        ]);
    }
}
