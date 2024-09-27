<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    final public function run(): void
    {
        $admins = [
            'name'     => 'Admin One',
            'email'    => 'rokibulhasan015814@gmail.com',
            'password' => Hash::make(User::DEFAULT_PASSWORD),
            'role' => User::ROLE_SUPERADMIN,
        ];
        $user   = User::query()->where('email', $admins['email'])->exists();
        if (!$user) {
            User::query()->create($admins);
        }
    }
}