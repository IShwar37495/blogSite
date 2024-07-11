<?php

namespace Database\Seeders;

use App\Models\blog;
use App\Models\comment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(50)->create();
        blog::factory()->count(50)->create();
        comment::factory()->count(100)->create();


           User::factory()->create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'), 
        'is_admin' => true, 
    ]);
    }


    
}
