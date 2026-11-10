<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::firstOrNew(['email' => 'admin@example.com']);
        $admin->forceFill([
            'name'     => 'Admin',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ])->save();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => Hash::make('password123')]
        );

        $this->call([
            PostTableSeeder::class,
            PostRandomSeeder::class,
            SkillSeeder::class,
        ]);
    }
}
