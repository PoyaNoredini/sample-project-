<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'user_name' => 'admin_user',
            'phone_number' => '09372718990',
            'user_type' => 'admin',
            'password' => Hash::make('admin123'),
            'gender' => 'other',
            'bio' => 'Administrator account',
        ]);
    }
} 