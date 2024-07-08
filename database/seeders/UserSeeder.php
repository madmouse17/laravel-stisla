<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'petugas']);
        $role3 = Role::create(['name' => 'anggota']);
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
        ]);
        $admin->assignRole($role1);
        $admin2 = User::create([
            'name' => 'petugas',
            'email' => 'petugas@test.com',
            'password' => Hash::make('password123'),
        ]);
        $admin2->assignRole($role2);
        $admin3 = User::create([
            'name' => 'anggota',
            'email' => 'anggota@test.com',
            'password' => Hash::make('password123'),
        ]);
        $admin3->assignRole($role3);
    }
}
