<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Get the Admin Role ID
        $adminRole = Role::where('slug', 'admin')->first();
       
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@rafting.com'],
            [
                'name' => 'Main Admin',
                'password' => Hash::make('password123'), // Change this immediately!
                'role_id' => $adminRole->id,
            ]
        );

      
    }
}