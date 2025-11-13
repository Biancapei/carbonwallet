<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default admin user
        User::updateOrCreate(
            ['email' => 'admin@carbonwallet.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Password123'),
                'email_verified_at' => now(),
            ]
        );

        // User's email
        User::updateOrCreate(
            ['email' => 'biancapei.tpy@gmail.com'],
            [
                'name' => 'Bianca',
                'password' => Hash::make('Password123'),
                'email_verified_at' => now(),
            ]
        );
    }
}
