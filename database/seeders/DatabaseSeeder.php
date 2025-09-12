<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        if(User::find())

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'phone' => '085729084638',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'phone' => '081947164825',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
