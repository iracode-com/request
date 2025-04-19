<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Enums\UserRole;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name'   => 'Iracode',
            'email'  => 'admin@gmail.com',
            'role'   => UserRole::ADMIN,
            'mobile' => '09120000000',
            'mobile_verified_at' => now(),
            'password' => Hash::make('1234Mm'),
            'status' => true
        ]);
        $user->syncRoles('super_admin');
    }
}
