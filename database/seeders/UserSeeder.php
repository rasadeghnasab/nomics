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
        User::factory()->create([
            'name' => 'Test',
            'email' => 'test@local.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Test 2',
            'email' => 'test2@local.com',
            'password' => Hash::make('password'),
        ]);

        User::factory(10)->create();
    }
}
