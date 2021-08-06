<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
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
            'name' => 'Peter',
            'email' => 'peter.marirosans@quant.network',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Theodore',
            'email' => 'Theodore.Sentelidis@quant.network',
            'password' => Hash::make('password'),
        ]);

        User::factory(10)->create();
    }
}
